<template>
    <v-card>
        <v-data-table
            :headers="headers"
            :items="clientes"
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar flat color="white">
                    <v-toolbar-title><strong>Clientes</strong></v-toolbar-title>
                    <v-divider
                    class="mx-4"
                    inset
                    vertical
                    ></v-divider>
                    <v-spacer></v-spacer> 
                    <ImportForm
                        v-on:updTable="actualizarTable($event)">
                    </ImportForm>
                    <UserCreateForm 
                        v-on:updTable="actualizarTable($event)">
                    </UserCreateForm>
                </v-toolbar>
            </template>
            <template v-slot:item.actions="{ item }">
                <v-btn outlined color="red" x-small dark
                @click="borrarCliente(item)"> 
                <v-icon left>mdi-trash-can-outline</v-icon>
                    Borrar
                </v-btn>
                <v-btn outlined color="green" x-small dark @click="editModal(item)">
                <v-icon left>mdi-pencil-outline</v-icon>
                    Editar
                </v-btn>
            </template>
        </v-data-table>
         <EditClientForm v-model="cliente"
         v-on:updTable="actualizarTable($event)"
         @disable="cerrarForm($event)" 
         :open="openModal">
         </EditClientForm>
    </v-card>
</template>
<script>
    import ImportForm from '@/js/components/ImportForm';
    import UserCreateForm from '@/js/components/UserCreateForm';
    import EditClientForm from '@/js/components/EditClientForm';
    export default {
        name: 'Clients',
        components: {
            UserCreateForm,
            EditClientForm,
            ImportForm,
        },
        mounted: function(){
            this.getClients()
        },
        data: () => {
            return {
                headers:[
                    { text: '#', value: 'id' },
                    { text: 'Nombre', value: 'name' },
                    { text: 'Telefono', value: 'phone' },
                    { text: 'Acciones',value: 'actions'},
                ],
                clientes: [],
                eliminado:false,
                openModal:false,
                cliente:{
                    id:'',
                    name:'',
                    address:'',
                    phone:'',
                },
                 editedIndex: -1,
            }  
        },
        methods: {
            getClients(){
                axios.get('api/clients')
                    .then(response=>{
                        this.clientes = response.data
                        console.log(response)
                    })
                    .catch(error=>{
                        console.log(error)
                    })
            },
            actualizarTable(event){
                console.log(event)
                if(event)
                {
                    this.getClients()
                }
            },
            borrarCliente(item){
                const index = this.clientes.indexOf(item)
                const id = this.clientes[index].id;
                axios.post('api/clients/'+id)
                    .then(response=>{
                        this.eliminado=true
                        this.actualizarTable(this.eliminado)
                        alert('Borrado')
                    })
                    .catch(error=>{
                        console.log(error)
                    })
            },
            abrirForm(){
                this.openModal = true
            },
            cerrarForm(data){
                this.openModal = data
            },
            editModal(item){
                this.editedIndex = this.clientes.indexOf(item)
                this.cliente = Object.assign({}, item)
                this.abrirForm()
            },
            
        },
    }
</script>
