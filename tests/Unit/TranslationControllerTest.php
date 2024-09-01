<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TranslationControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_json_validation()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $invalidJson = UploadedFile::fake()->create('invalid.json', 100, 'application/json');

        $response = $this->postJson('/api/translate', [
            'json_file' => $invalidJson,
            'target_language' => 'French'
        ]);

        $response->assertStatus(400)
                 ->assertJson(['error' => 'Invalid JSON file']);
    }

    public function test_successful_translation()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $validJson = json_encode(['test' => 'Hello World']);
        $jsonFile = UploadedFile::fake()->createWithContent('valid.json', $validJson);

        $response = $this->postJson('/api/translate', [
            'json_file' => $jsonFile,
            'target_language' => 'French'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['download_url']);

        $files = Storage::disk('public')->files();

        $filenamePattern = '/^translated_\d+\.json$/';
        $matchingFile = null;

        foreach ($files as $file) {
            if (preg_match($filenamePattern, basename($file))) {
                $matchingFile = $file;
                break;
            }
        }

        $this->assertNotNull($matchingFile, 'Translated JSON file not found in storage');

        if ($matchingFile) {
            $content = Storage::disk('public')->get($matchingFile);
            $decodedContent = json_decode($content, true);

            $this->assertIsArray($decodedContent, 'File content is not a valid JSON');
            $this->assertArrayHasKey('test', $decodedContent, 'Translated content does not have expected structure');
        }
    }

    public function test_authentication_required()
    {
        $validJson = json_encode(['test' => 'Hello World']);
        $jsonFile = UploadedFile::fake()->createWithContent('valid.json', $validJson);

        $response = $this->postJson('/api/translate', [
            'json_file' => $jsonFile,
            'target_language' => 'French'
        ]);

        $response->assertStatus(401);
    }

    public function test_registration_and_login()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['access_token', 'token_type']);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['access_token', 'token_type']);
    }

    public function test_file_saving()
    {
        $content = json_encode(['test' => 'Hello World']);
        $fileName = 'test_' . time() . '.json';
        
        Storage::disk('public')->put($fileName, $content);
        
        $this->assertTrue(Storage::disk('public')->exists($fileName), 'File was not saved to storage');
        $this->assertEquals($content, Storage::disk('public')->get($fileName), 'Saved file content does not match expected content');
    }
}