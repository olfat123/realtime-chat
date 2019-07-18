<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" >
                <div class="card card-default" >
                    <div class="card-header">Messages</div>

                    <div class="card-body" >
                       <ul class="list-unstyled" style="max-height:400px;overflow-y:scroll" v-chat-scroll>
                           <li v-for="(message, index) in messages" :key="index">
                               <strong>{{ message.user.name }}</strong>
                               {{ message.message }}
                           </li>
                       </ul>
                    </div>
                    <input 
                    @keydown="sendTypingEvent"
                    @keyup.enter="sendMessage" 
                    v-model="newMessage" 
                    type="text" 
                    name="message" 
                    placeholder="Enter your message..." 
                    class="form-control">
                </div>
                <span class="text-muted" v-if="activeUser">{{ activeUser.name }} is typing... </span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['user'],
        data(){
            return{
                messages: [],
                newMessage: '',
                activeUser: false,
            }
        },
        created(){
            this.fetchMessages();

            Echo.join('moordyChannel')
                .listen('MessageSent', (event) => {
                    this.messages.push(event.message);
                })
                .listenForWhisper('typing',user =>{
                    this.activeUser = user;
                    console.log('typing');
                   // console.log('response');
                })
        },
        methods: {
            fetchMessages(){
                axios.get('messages').then(response => {
                    this.messages = response.data;
                })
            },
            sendMessage(){
                this.messages.push({
                    user: this.user,
                    message: this.newMessage
                });

                axios.post('messages', {message: this.newMessage})
            },
            sendTypingEvent(){
                Echo.join('moordyChannel')
                    .whisper('typing',this.user);
                console.log('typing');
            }
        },
    }
</script>
