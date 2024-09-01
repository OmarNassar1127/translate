<?php

namespace App\Http\Controllers;

use OpenAI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TranslationController extends Controller
{
    protected $openai;

    public function __construct()
    {
        $this->openai = OpenAI::client(config('app.openai_api_key'));
    }

    public function translate(Request $request)
    {
        set_time_limit(600);

        $request->validate([
            'json_file' => 'required|file',
            'target_language' => 'required|string',
        ]);

        $jsonContent = file_get_contents($request->file('json_file')->path());
        $jsonData = json_decode($jsonContent, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Invalid JSON file'], 400);
        }

        $targetLanguage = $request->target_language;

        $translatedData = $this->translateRecursive($jsonData, $targetLanguage);

        // Sla het vertaalde JSON-bestand op
        $fileName = 'translated_' . time() . '.json';
        Storage::put('public/' . $fileName, json_encode($translatedData, JSON_PRETTY_PRINT));

        // Retourneer de URL naar het bestand
        $downloadUrl = Storage::url($fileName);

        return response()->json(['download_url' => $downloadUrl]);
    }

    private function translateRecursive($data, $targetLanguage)
    {
        if (is_string($data)) {
            return $this->translateText($data, $targetLanguage);
        }

        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = $this->translateRecursive($value, $targetLanguage);
            }
        }

        return $data;
    }

    private function translateText($text, $targetLanguage)
    {
        $retries = 3;
        $delay = 1000;

        while ($retries > 0) {
            try {
                $response = $this->openai->chat()->create([
                    'model' => 'gpt-4o-mini',
                    'messages' => [
                        ['role' => 'system', 'content' => "You are a translator. Translate the following text to $targetLanguage:"],
                        ['role' => 'user', 'content' => $text],
                    ],
                ]);

                return $response->choices[0]->message->content;
            } catch (\Exception $e) {
                Log::error('Translation error: ' . $e->getMessage());
                $retries--;
                if ($retries === 0) {
                    throw $e;
                }
                usleep($delay * 1000);
                $delay *= 2;
            }
        }
    }
}
