<template>
    <app-layout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Chat
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex overflow-hidden bg-white shadow-xl sm:rounded-lg" style="min-height: 400px; max-height: 400px;">

                    <!-- list users -->
                    <div class="w-1/4 overflow-y-auto bg-gray-200 border-r border-gray-200 bg-opacity-25">
                        <ul>
                            <li
                                v-for="user in users" :key="user.id"
                                @click="() => {loadMessages(user.id)}"
                                :class="(userActive && userActive.id === user.id) ? 'bg-gray-200 bg-opacity-50' : ''"
                                class="p-6 text-lg font-semibold leading-7 text-gray-600 border-b border-gray-200 cursor-pointer hover:bg-gray-200 hover:bg-opacity-50">
                                <p class="flex items-center">
                                    {{ user.name }}
                                    <span
                                        v-if="user.notification"
                                        class="w-2 h-2 ml-2 bg-blue-500 rounded-full"></span>
                                </p>
                            </li>
                        </ul>
                    </div>

                    <!-- box message -->
                    <div class="flex flex-col justify-between w-3/4">

                        <!-- message -->
                        <div class="flex flex-col w-full p-6 overflow-y-auto">
                            <div
                                v-for="message in messages" :key="message.id"
                                :class="(message.from === $page.auth.user.id) ? 'text-right' : ''"
                                class="w-full mb-3 message">
                                <p
                                    :class="(message.from === $page.auth.user.id) ? 'messageFromMe' : 'messageToMe'"
                                    class="inline-block p-2 rounded-md" style="max-width: 75%;">
                                    {{ message.content }}
                                </p>
                                <span class="block mt-1 text-xs text-gray-500">{{ message.created_at | formatDate }}</span>
                            </div>
                        </div>

                        <!-- form -->
                        <div
                            v-if="userActive"
                            class="w-full p-6 bg-gray-300 border-t border-gray-200 bg-opacity-25">
                            <form v-on:submit.prevent="sendMessage">
                                <div class="flex overflow-hidden border border-gray-300 rounded-md">
                                    <input
                                        v-model="message"
                                        type="text"
                                        class="flex-1 px-4 py-2 text-sm focus:outline-none focus:shadow-inner">
                                    <button
                                        type="submit"
                                        class="px-4 py-2 text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import Vue from 'vue';
    import AppLayout from '@/Layouts/AppLayout';
    import store from "@/store";

    export default {
        components: {
            AppLayout,
        },
        data() {
            return {
                users: [],
                messages: [],
                userActive: null,
                message: ''
            }
        },
        computed: {
            user() {
                return store.state.user
            }
        },
        methods: {
            scrollToBottom: function() {
                if(this.messages.length) {
                    document.querySelectorAll('.message:last-child')[0].scrollIntoView();
                }
            },
            loadMessages: async function (userId) {
                await axios.get(`api/users/${userId}`).then(response => {
                    this.userActive = response.data.user;
                });
                await axios.get(`api/messages/${userId}`).then(response => {
                    this.messages = response.data.messages;
                });

                const user = this.users.filter((user) => {
                    if(user.id === userId) {
                        return user
                    }
                });

                if(user) {
                    Vue.set(user[0], "notification", false)
                }

                this.scrollToBottom();
            },
            sendMessage: async function () {
                await axios.post('api/messages/store', {
                    'content': this.message,
                    'to': this.userActive.id
                }).then(response => {
                    this.messages.push({
                        'from': this.user.id,
                        'to': this.userActive.id,
                        'content': this.message,
                        'created_at': new Date().toISOString(),
                        'updated_at': new Date().toISOString(),
                    });

                    this.message = '';
                });

                this.scrollToBottom();
            },
        },
        mounted() {
            axios.get('api/users').then(response => {
                this.users = response.data.users;
            });

            Echo.private(`user.${this.user.id}`).listen('.SendMessage', async (e) => {
                if(this.userActive && this.userActive.id === e.message.from) {
                    await this.messages.push(e.message);
                    this.scrollToBottom();
                } else {
                    const user = this.users.filter((user) => {
                        if(user.id === e.message.from) {
                            return user
                        }
                    });

                    if(user) {
                        Vue.set(user[0], "notification", true)
                    }
                }
            });
        }
    }
</script>

<style>
    .messageFromMe {
        @apply bg-indigo-300 bg-opacity-25;
    }
    .messageToMe {
        @apply bg-gray-300 bg-opacity-25;
    }
</style>
