require('./bootstrap');

import Vue from 'vue';
import axios from 'axios'; // Add this import

window.Vue = Vue;

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('chat-messages', require('./components/ChatMessages.vue').default);
Vue.component('chat-form', require('./components/ChatForm.vue').default);

const app = new Vue({
    el: '#app',

    data: {
        messages: [],
        newMessage: '',
        user: '',
        typing: false,
        
    },

    created() {
        this.fetchMessages();
        window.Echo.private('chat')
            .listen('.MessageSent', (e) => {
                // console.log('Message received:', e.message.message);
                this.messages.push({
                    message: e.message.message,
                    user: e.user
                });
            })
            .listenForWhisper('typing', (e) => {
                this.user = e.user;
                this.typing = e.typing;
                // console.log(this.user.name); 
    
                setTimeout(() => {
                    this.typing = false;
                }, 900);
            });


            
    },

    methods: {
        fetchMessages() {
            axios.get('/messages').then(response => {
                this.messages = response.data;
                console.log('Fetched messages:', this.messages);
            });
        },

        addMessage(message) {
            this.messages.push(message);

            axios.post('/messages', message).then(response => {
                console.log(response.data);
            });
        },

        sendMessage() {
            // add new message to messages array
            this.messages.push({
                user: Laravel.user,
                message: this.newMessage
            });

            // clear input field
            this.newMessage = '';

            
        },

        // isTyping() {
        //     let channel = Echo.channel('chat');

        //     setTimeout(function () {
        //         channel.whisper('typing', {
        //             user: Laravel.user,
        //             typing: true
        //         });
        //     }, 300);
        // },


    }
});







