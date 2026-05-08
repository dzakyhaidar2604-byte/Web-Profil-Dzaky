<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $userMessage = $request->input('message');
        $apiKey = env('OPENAI_API_KEY');

        // Fallback: Dummy Response (Rule-based) jika API Key tidak ada
        if (!$apiKey) {
            $lowerMessage = strtolower($userMessage);
            $reply = "Halo Maszeh! Saya asisten virtual (Mode Dummy). ";
            if (str_contains($lowerMessage, 'skill')) $reply .= "Skill utamanya adalah Laravel, Tailwind, dan MySQL.";
            elseif (str_contains($lowerMessage, 'project') || str_contains($lowerMessage, 'portofolio')) $reply .= "Cek bagian atas untuk melihat project terbaru!";
            else $reply .= "Ada yang bisa saya bantu terkait profil, skill, atau project?";
            
            return response()->json(['reply' => $reply]);
        }

        // Integrasi OpenAI API
        try {
            $response = Http::withToken($apiKey)->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'Kamu adalah AI asisten untuk website portofolio Maszeh. Jawab singkat, ramah, dan profesional bergaya Gen Z. Maszeh adalah Fullstack Developer (Laravel, Vue/Alpine, Tailwind).'],
                    ['role' => 'user', 'content' => $userMessage]
                ]
            ]);

            return response()->json(['reply' => $response['choices'][0]['message']['content']]);
        } catch (\Exception $e) {
            return response()->json(['reply' => 'Waduh, koneksi ke AI sedang gangguan Maszeh. Coba lagi nanti ya!']);
        }
    }
}