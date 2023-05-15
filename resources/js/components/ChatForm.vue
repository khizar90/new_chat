<template>
    <div>
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Type your message..." v-model="newMessage"
                v-on:keyup.enter="sendMessage" v-on:keydown="isTyping">

            <span class="input-group-btn">
                <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
                    Send
                </button>
            </span>
        </div>
        <!-- <span v-if="typing" class="help-block" style="font-style: italic;">{{ typingUser }} is typing...</span> -->
    </div>
</template>

<script>
export default {
    props: ['user'],

    data() {
        return {
            newMessage: '',
            typing: false,
        }
    },

    methods: {
        sendMessage() {
            this.$emit('messagesent', {
                user: this.user,
                message: this.newMessage
            });
            console.log('Sent message:', this.newMessage);

            this.newMessage = '';
        },

        isTyping() {
            this.typing = true;

            window.Echo.private('chat')
                .whisper('typing', {
                    user: this.user,
                    typing: true,
                });

            setTimeout(() => {
                this.typing = false;
            }, 900);

            // this.typing = true;
            // window.Echo.channel('chat')
            //     .listen('TypingEvent', {
            //         user: this.user,
            //         typing: true,
            //     });

            // setTimeout(() => {
            //     this.typing = false;
            // }, 900);

            // this.typing = true;
            // window.Echo.private('chat')
            //     .whisper('typing', {
            //         user: this.user,
            //         typing: true,
            //     });

            // setTimeout(() => {
            //     this.typing = false;
            // }, 900);

            // window.Echo.private('chat')
            //     .whisper('typing', {
            //         user: this.user,
            //         typing: true,
            //     });





            // this.typing = true;

            // let channel = window.Echo.private('chat'); 

            // channel.whisper('typing', {
            //     user: this.user,
            //     typing: true,
            // });

            // setTimeout(() => {
            //     this.typing = false;
            // }, 900);

            

                // let channel = Echo.private('chat')

                // setTimeout(() => {
                //     channel.whisper('typing', {
                //         user: this.user,
                //         typing: true
                //     })
                // }, 300)
        


        }
    }
}
</script>
