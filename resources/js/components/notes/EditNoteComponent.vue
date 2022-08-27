<template>
    <div>

        
        <div class="min-w-screen flex items-center justify-center font-sans overflow-hidden">
            <div class="w-full lg:w-4/6">

                <button type="button" class="
                    px-6
                    py-2.5
                    bg-blue-600
                    text-white
                    font-medium
                    text-xs
                    leading-tight
                    uppercase
                    rounded
                    shadow-md
                    hover:bg-blue-700 hover:shadow-lg
                    focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                    active:bg-blue-800 active:shadow-lg
                    transition
                    duration-150
                    ease-in-out"
                    @click="irANotas()">
                    Regresar a mis notas
                </button>

                <div v-if="success" class="alert bg-green-100 rounded-lg py-5 px-6 mb-3 text-base text-green-700 inline-flex items-center w-full alert-dismissible fade show" role="alert">
                    <strong class="mr-1">Cambios guardados!</strong>
                    <button type="button" class="btn-close box-content w-4 h-4 p-1 ml-auto text-yellow-900 border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-yellow-900 hover:opacity-75 hover:no-underline" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <div v-if="error" class="bg-red-100 rounded-lg py-5 px-6 mb-4 text-base text-red-700 mb-3" role="alert">
                    {{error_mesagge}}
                </div>

                <div class="block p-6 rounded-lg shadow-lg bg-white">
                    <form>
                        
                        <!-- Select cliente -->
                        <div class="form-group mb-6">
                            <label for="exampleInputEmail1" class="form-label inline-block mb-2 text-gray-700">
                                {{(cargando) ? 'Cargando clientes ...' : 'Cliente'}}
                            </label>
                            <select class="form-select appearance-none
                                block
                                w-full
                                px-3
                                py-1.5
                                text-base
                                font-normal
                                text-gray-700
                                bg-white bg-clip-padding bg-no-repeat
                                border border-solid border-gray-300
                                rounded
                                transition
                                ease-in-out
                                m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example"
                                v-model="customer_id">
                                    
                                    <option value="">Seleccionar cliente</option>
                                    <option v-for="(customer, index) in customers" :key="index" :value="customer.id">
                                        {{customer.name}}
                                    </option>
                            </select>
                        </div>

                        <!-- Fecha -->
                        <div class="form-group mb-6">
                            <label for="exampleInputPassword1" class="form-label inline-block mb-2 text-gray-700">Fecha</label>
                            <input v-model="date_note" type="date" class="form-control block
                                w-full
                                px-3
                                py-1.5
                                text-base
                                font-normal
                                text-gray-700
                                bg-white bg-clip-padding
                                border border-solid border-gray-300
                                rounded
                                transition
                                ease-in-out
                                m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputPassword1"
                                placeholder="Fecha">
                        </div>

                        <!-- Total note -->
                        <div class="form-group mb-6">
                            <label for="exampleInputPassword1" class="form-label inline-block mb-2 text-gray-700">Total de la nota</label>
                            <input type="text" disabled :value="'$' + total" class="form-control block
                                w-full
                                px-3
                                py-1.5
                                text-base
                                font-normal
                                text-gray-700
                                bg-white bg-clip-padding
                                border border-solid border-gray-300
                                rounded
                                transition
                                ease-in-out
                                m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputPassword1"
                                placeholder="Fecha">
                        </div>

                        <!-- Search item -->
                        <div class="form-group mb-6">
                            <label for="exampleInputPassword1" class="form-label inline-block mb-2 text-gray-700">Buscar item</label>
                            <input v-model="search_item" type="text" class="form-control block
                                w-full
                                px-3
                                py-1.5
                                text-base
                                font-normal
                                text-gray-700
                                bg-white bg-clip-padding
                                border border-solid border-gray-300
                                rounded
                                transition
                                ease-in-out
                                m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputPassword1"
                                placeholder="Buscar por nombre o sku">
                        </div>

                        

                        <div v-if="items.length > 0">
                            <ul class="bg-white rounded-lg border border-gray-200 w-96 text-gray-900 max-w">
                                <li class="px-6 py-2 border-b border-gray-200 w-full rounded-t-lg"
                                    v-for="(item, index) in items" :key="index">
                                    {{item.name}}
                                    <button type="button" class=" inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                                    @click="addItem(item)">
                                        Agregar
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <br>

                        
                            

                    
                        <button type="button" class="
                        px-6
                        py-2.5
                        bg-blue-600
                        text-white
                        font-medium
                        text-xs
                        leading-tight
                        uppercase
                        rounded
                        shadow-md
                        hover:bg-blue-700 hover:shadow-lg
                        focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                        active:bg-blue-800 active:shadow-lg
                        transition
                        duration-150
                        ease-in-out"
                        @click="saveNote()">Guardar cambios</button>
                    </form>
                </div>
            </div>

        </div>

        <!-- Items agregados -->
        <div class="overflow-x-auto">
            <div class="min-w-screen flex items-center justify-center font-sans overflow-hidden">
                <div class="w-full lg:w-5/6">
                    <div class="bg-white shadow-md rounded my-6">

                        <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">#</th>
                                    <th class="py-3 px-6 text-left">Item</th>
                                    <th class="py-3 px-6 text-center">Precio</th>
                                    <th class="py-3 px-6 text-center">Cantidad</th>
                                    <th class="py-3 px-6 text-center">Total</th>
                                    <th class="py-3 px-6 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                <tr 
                                    v-for="(item, index) in items_adds" :key="index"
                                    class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="font-medium">{{index}}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <div class="flex items-center">
                                            <span>{{item.name}}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <div class="flex items-center">
                                            <span>{{item.price}}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            {{item.quantity}}
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">
                                            ${{item.price * item.quantity}}
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div @click="deleteItem(item)" class="flex item-center justify-center">
                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
   
</template>

<script>
export default {
    data(){
        return {
            note_id : "",
            cargando : true,
            customers : [],
            customer_id : "",
            date_note : "",
            items_adds : [],
            items : [],
            search_item : "",
            error_mesagge : "",
            error : false,
            success : false
        }
    },
    mounted(){
        this.note_id     = this.$route.params.id;
        this.getNote();
        this.getCustomers();
    },
    methods: {
        getNote(){
            
            axios.get('/api/notes/' + this.note_id).then( (response) => {
                
                console.log(response.data);

                this.customer_id = response.data.customer_id;
                this.date_note   = response.data.date;
                this.items_adds  = response.data.items; 

            }).catch( ({response}) => {
                console.log(response);
            }).then(() => {
                this.cargando = false;
            })

        },
        getCustomers(){

            this.cargando = true;
            
            axios.get('/api/customers').then( (response) => {
                this.customers = response.data;
            }).catch( ({response}) => {
                console.log(response);
            }).then(() => {
                this.cargando = false;
            })

        },
        getItemsSearch(){

            axios.get('/api/items?search=' + this.search_item).then( (response) => {
                this.items = response.data;
            }).catch( ({response}) => {
                console.log(response);
            }).then(() => {
                this.cargando = false;
            })
        },
        addItem(item){

            if(this.itemIsPresent(item)){

                for(let i = 0; i < this.items_adds.length; i++)
                {
                    if(this.items_adds[i].id == item.id){
                        this.items_adds[i].quantity = this.items_adds[i].quantity + 1; 
                        this.items_adds[i].total = this.items_adds[i].quantity * this.items_adds[i].price; 
                    }
                }

            }else{

                this.items_adds.push({
                    id : item.id,
                    name : item.name,
                    price : item.price,
                    quantity : 1,
                    total : item.price
                })

            }
        },
        itemIsPresent(item){

            for(let item_ of this.items_adds){
                if(item_.id == item.id){
                    return true;
                }
            }

            return false;

        },
        deleteItem(item){
            this.items_adds = this.items_adds.filter((item_) => {
                return item.id != item_.id;
            })
        },
        saveNote(){

            this.error = false;
            this.success = false;

            if(this.items_adds.length == 0){
                this.error = true;
                this.error_mesagge = "Agregar por lo menos un item";
                return false;
            }

            if(this.customer_id == ""){
                this.error = true;
                this.error_mesagge = "Selecciona un cliente";
                return false;
            }

            if(this.date_note == ""){
                this.error = true;
                this.error_mesagge = "Selecciona una fecha";
                return false;
            }

            axios.put('/api/notes/' + this.note_id, {
                customer_id : this.customer_id,
                total : this.total,
                date  : this.date_note,
                items : this.items_adds
            }).then( (response) => {

                this.success = true;

            }).catch( ({response}) => {
                console.log(response);
            }).then(() => {
                this.cargando = false;
            })

        },
        irANotas(){
            this.$router.push({name: "home"})
        }
    },
    computed: {
        total(){

            let total = 0;

            for(let item_ of this.items_adds){
                total = total + (item_.price * item_.quantity);
            }

            return total;

        }
    },
    watch: {
        search_item(){
            this.getItemsSearch();
        }
    }
}
</script>