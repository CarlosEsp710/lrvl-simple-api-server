<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Clients' }}
        </h2>
    </x-slot>
    <div id="app">
        <x-container class="py-8">
            {{-- Creta --}}
            <x-form-section>
                <x-slot name="title">
                    Create a new client
                </x-slot>
                <x-slot name="description">
                    Enter the requested data to create a new client
                </x-slot>

                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-4">

                        <div v-if="createForm.errors.length > 0"
                            class="mb-4 bg-red-100 border border-red-400 text-red-400 px-4 py-3 rounded">
                            <strong>Ups!</strong>
                            <span>Something went wrong</span>
                            <ul>
                                <li v-for="error in createForm.errors">
                                    @{{ error }}
                                </li>
                            </ul>
                        </div>

                        <x-label>Name</x-label>
                        <x-input v-model="createForm.name" type="text" class="w-full mt-1" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-label>URL redirec</x-label>
                        <x-input v-model="createForm.redirect" type="text" class="w-full mt-1" />
                    </div>
                </div>

                <x-slot name="actions">
                    <x-button v-on:click="store" v-bind:disabled="createForm.disabled">
                        Create
                    </x-button>
                </x-slot>
            </x-form-section>
            {{-- Show --}}
            <x-form-section v-if="clients.length > 0" class="mt-12">
                <x-slot name="title">
                    Clients list
                </x-slot>
                <x-slot name="description">
                    All clients you've added
                </x-slot>

                <div>
                    <table class="text-gray-600">
                        <thead class="border-b border-gray-300">
                            <tr class="text-left">
                                <th class="py-2 w-full">Name</th>
                                <th class="py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300">
                            <tr v-for="client in clients">
                                <td class="py-2">@{{ client.name }}</td>
                                <td class="py-2 flex divide-x divide-gray-300">
                                    <a v-on:click="show(client)"
                                        class="pr-2 hover:text-green-600 font-semibold cursor-pointer">
                                        Show
                                    </a>
                                    <a v-on:click="edit(client)"
                                        class="px-2 hover:text-blue-600 font-semibold cursor-pointer">
                                        Edit
                                    </a>
                                    <a v-on:click="deleteClient(client)"
                                        class="pl-2 hover:text-red-600 font-semibold cursor-pointer">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


            </x-form-section>
        </x-container>

        {{-- Modal Update --}}
        <x-dialog-modal modal="editForm.open">
            <x-slot name="title">Edit client</x-slot>
            <x-slot name="content">
                <div class="space-y-6">
                    <div v-if="editForm.errors.length > 0"
                        class="bg-red-100 border border-red-400 text-red-400 px-4 py-3 rounded">
                        <strong>Ups!</strong>
                        <span>Something went wrong</span>
                        <ul>
                            <li v-for="error in editForm.errors">
                                @{{ error }}
                            </li>
                        </ul>
                    </div>
                    <div class="">
                        <x-label>Name</x-label>
                        <x-input v-model="editForm.name" type="text" class="w-full mt-1" />
                    </div>
                    <div class="">
                        <x-label>URL redirec</x-label>
                        <x-input v-model="editForm.redirect" type="text" class="w-full mt-1" />
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button v-on:click="updateClient" v-bind:disabled="editForm.disabled" type="button"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50">
                        Update
                    </button>
                    <button v-on:click="close" type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </x-slot>
        </x-dialog-modal>
        {{-- Modal Credentials --}}
        <x-dialog-modal modal="credentials.open">
            <x-slot name="title">Credentials</x-slot>
            <x-slot name="content">
                <div class="space-y-6">
                    <div class="">
                        <x-label>CLIENT:</x-label>
                        <p v-text="credentials.name"></p>
                    </div>
                    <div class="">
                        <x-label>CLIENT_ID:</x-label>
                        <p v-text="credentials.id"></p>
                    </div>
                    <div class="">
                        <x-label>CLIENT_SECRET:</x-label>
                        <p v-text="credentials.secret"></p>
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button v-on:click="credentials.open = false" type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Close
                    </button>
                </div>
            </x-slot>
        </x-dialog-modal>
    </div>


    @push('js')
        <script>
            new Vue({
                el: "#app",
                data: {
                    createForm: {
                        disabled: false,
                        errors: [],
                        name: null,
                        redirect: null,
                    },
                    editForm: {
                        disabled: false,
                        errors: [],
                        id: null,
                        name: null,
                        redirect: null,
                        open: false,
                    },
                    credentials: {
                        open: false,
                        id: null,
                        name: null,
                        secret: null,
                    },
                    clients: [],
                },
                mounted() {
                    this.getClients();
                    this.createForm.errors = [];
                    this.editForm.errors = [];
                },
                methods: {
                    close() {
                        this.editForm.open = false;
                        this.editForm.errors = [];
                    },
                    show(client) {
                        this.credentials.open = true;
                        this.credentials.id = client.id;
                        this.credentials.name = client.name;
                        this.credentials.secret = client.secret;
                    },
                    store() {
                        this.createForm.disabled = true;
                        axios
                            .post("/oauth/clients", this.createForm)
                            .then((response) => {
                                this.createForm.name = null;
                                this.createForm.redirect = null;
                                this.createForm.disabled = false;
                                this.createForm.errors = [];

                                this.show(response.data);

                                this.getClients();
                            })
                            .catch((error) => {
                                this.createForm.errors = _.flatten(_.toArray(error.response.data.errors));
                                this.createForm.disabled = false;
                            });
                    },
                    getClients() {
                        axios.get("/oauth/clients")
                            .then((response) => {
                                this.clients = response.data;
                            })
                            .catch((error) => {
                                console.log('Error getting clients');
                            })
                    },
                    deleteClient(client) {
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                axios.delete(`/oauth/clients/${client.id}`)
                                    .then((response) => {
                                        this.getClients();
                                    }).catch((error) => {
                                        console.log('Error');
                                    })
                            }
                        });
                    },
                    edit(client) {
                        this.editForm.open = true;
                        this.editForm.id = client.id;
                        this.editForm.name = client.name;
                        this.editForm.redirect = client.redirect;
                    },
                    updateClient() {
                        this.editForm.disabled = true;

                        axios.put(`/oauth/clients/${this.editForm.id}`, this.editForm)
                            .then((response) => {
                                this.editForm.name = null;
                                this.editForm.id = null;
                                this.editForm.redirect = null;
                                this.editForm.disabled = false;
                                this.editForm.errors = [];

                                this.editForm.open = false;

                                this.getClients();
                            })
                            .catch((error) => {
                                this.editForm.errors = _.flatten(_.toArray(error.response.data.errors));
                                this.editForm.disabled = false;
                            });
                    },
                },
            });
        </script>
    @endpush
</x-app-layout>
