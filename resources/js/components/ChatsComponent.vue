<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Messages</div>

                    <div class="card-body">
                       <ul class="list-unstyled">
                           <li v-for="(message, index) in messages" :key="index">
                               <strong>{{ message.user.name }}</strong>
                               {{ message.message }}
                           </li>
                       </ul>
                    </div>
                    <input @keyup.enter="sendMessage" v-model="newMessage" type="text" name="message" placeholder="Enter your message..." class="form-control">
                </div>
                <span class="text-muted">user is typing... </span>
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
                newMessage: ''
            }
        },
        created(){
            this.fetchMessages();
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
            }
        },
    }
</script>
