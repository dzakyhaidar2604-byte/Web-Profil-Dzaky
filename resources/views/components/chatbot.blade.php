<div x-data="chatbot()" class="fixed bottom-6 right-6 z-50 font-sans">
    
    <!-- Window Chat -->
    <div x-show="isOpen" x-transition.duration.300ms class="mb-4 w-80 sm:w-96 glass dark:glass-dark rounded-2xl shadow-2xl border flex flex-col overflow-hidden" style="height: 450px; display: none;">
        <!-- Header -->
        <div class="bg-gradient-to-r from-indigo-500 to-pink-500 p-4 flex justify-between items-center text-white">
            <div class="font-bold flex items-center gap-2">
                🤖 AI Assistant
            </div>
            <button @click="isOpen = false" class="hover:bg-white/20 p-1 rounded-lg transition-colors">✖</button>
        </div>

        <!-- Area Pesan -->
        <div id="chat-box" class="flex-1 p-4 overflow-y-auto flex flex-col gap-3 bg-white/50 dark:bg-gray-900/50">
            <!-- Template Pesan -->
            <template x-for="msg in messages" :key="msg.id">
                <div :class="msg.sender === 'user' ? 'self-end bg-indigo-600 text-white rounded-br-none' : 'self-start glass dark:glass-dark dark:text-white rounded-bl-none'" class="px-4 py-2 rounded-2xl max-w-[85%] text-sm shadow-sm whitespace-pre-wrap" x-text="msg.text"></div>
            </template>
            
            <!-- Loading Indicator -->
            <div x-show="isLoading" class="self-start glass dark:glass-dark rounded-2xl rounded-bl-none px-4 py-2 text-sm shadow-sm flex gap-1 items-center">
                <span class="animate-bounce w-2 h-2 bg-gray-400 rounded-full"></span>
                <span class="animate-bounce w-2 h-2 bg-gray-400 rounded-full delay-100"></span>
                <span class="animate-bounce w-2 h-2 bg-gray-400 rounded-full delay-200"></span>
            </div>
        </div>

        <!-- Input Box -->
        <form @submit.prevent="sendMessage" class="p-3 bg-white dark:bg-gray-800 border-t dark:border-gray-700 flex gap-2">
            <input x-model="inputText" type="text" placeholder="Tanya sesuatu..." class="flex-1 bg-gray-100 dark:bg-gray-900 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:text-white" :disabled="isLoading">
            <button type="submit" class="bg-indigo-600 text-white p-2 w-10 h-10 rounded-full hover:bg-indigo-700 transition-colors flex items-center justify-center disabled:opacity-50" :disabled="isLoading || inputText.trim() === ''">
                ➤
            </button>
        </form>
    </div>

    <!-- Floating Button -->
    <button @click="isOpen = !isOpen" class="w-14 h-14 bg-gradient-to-r from-indigo-600 to-pink-500 rounded-full flex items-center justify-center shadow-lg shadow-indigo-500/40 hover:scale-110 transition-transform focus:outline-none float-right">
        <span class="text-2xl text-white">💬</span>
    </button>
</div>

<script>
    function chatbot() {
        return {
            isOpen: false,
            isLoading: false,
            inputText: '',
            messages: [
                { id: 1, sender: 'bot', text: 'Halo! Saya asisten AI Maszeh. Ada yang ingin ditanyakan tentang skill atau project-nya?' }
            ],
            async sendMessage() {
                if (this.inputText.trim() === '') return;
                
                const userMsg = this.inputText;
                this.messages.push({ id: Date.now(), sender: 'user', text: userMsg });
                this.inputText = '';
                this.isLoading = true;
                
                this.scrollToBottom();

                try {
                    const response = await fetch('/api/chat', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ message: userMsg })
                    });
                    
                    const data = await response.json();
                    this.messages.push({ id: Date.now(), sender: 'bot', text: data.reply });
                } catch (error) {
                    this.messages.push({ id: Date.now(), sender: 'bot', text: 'Koneksi error, coba lagi nanti ya!' });
                } finally {
                    this.isLoading = false;
                    this.scrollToBottom();
                }
            },
            scrollToBottom() {
                setTimeout(() => {
                    const chatBox = document.getElementById('chat-box');
                    if(chatBox) chatBox.scrollTop = chatBox.scrollHeight;
                }, 100);
            }
        }
    }
</script>