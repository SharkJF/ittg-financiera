<template>
   <v-card>
        <v-data-table
            :headers="headers"
            :items="pagos"
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar flat color="white">
                </v-toolbar>
                <v-toolbar flat color="white">
                    <v-toolbar-title><strong>Pagos y abonos</strong></v-toolbar-title>
                    <v-divider
                    class="mx-4"
                    inset
                    vertical
                    ></v-divider>
                    <v-spacer></v-spacer>
                    <v-data-table
                    :headers="cabezas"
                    :items="payments"
                    class="elevation-1">
                    <template>
                    </template>
                    <template v-slot:item.name="{ item }">
                        {{ item.client.name }}
                    </template>
                    </v-data-table>
                </v-toolbar>
                <v-toolbar flat color="white">
                    <v-btn
                    outlined color="green"
                    class="mr-4"
                    @click="abonar"
                    >
                    <v-icon left>mdi-cash</v-icon>
                    Abonar
                    </v-btn>
                    <v-divider
                    class="mx-4"
                    inset
                    vertical
                    ></v-divider>
                    <v-col cols="2">
                    <v-text-field
                    v-model="pago.received_amount"
                    type="number"
                    label="Monto a abonar"
                    outlined
                    required
                    prepend-icon="mdi-currency-usd"
                    ></v-text-field>
                    </v-col>
                </v-toolbar>
            </template>
        </v-data-table>
    </v-card>
</template>

<script>

export default {
    name:'abonoView',
    mounted(){
        let id = this.$route.params.id
        this.getInfo()
        this.getData()
    },
    data:()=>{
        return{
             headers:[
                    { text: '#', value: 'number' },
                    { text: 'Cuota', value: 'amount' },
                    { text: 'Abonado', value: 'received_amount' },
                    { text: 'Fecha de pago', value: 'receipt_date' },
                    { text: 'Fecha de abono', value: 'payment_date' },
                ],
            cabezas:[
                    { text: 'Nombre', value: 'name' },
                    { text: 'Saldo Abonado', value: 'saldo_abonado' },
                    { text: 'Saldo Pendiente', value: 'saldo_pendiente' },
                ],
            pagos:[],
            payments:[],
            pago:{
                received_amount:0
            }
        }
    },
    methods:{
        getInfo(){
            let id = this.$route.params.id
            axios.get('/api/payments/'+id)
                 .then(response=>{
                        this.pagos = response.data
                    })
                    .catch(error=>{

                        console.log(error)
                    })
        },
        getData(){
            let id = this.$route.params.id
            axios.get('/api/payments/info/'+id)
                 .then(response=>{
                        this.payments = response.data
                    })
                    .catch(error=>{

                        console.log(error)
                    })
        },
        abonar(){
            let id = this.$route.params.id
            axios.put('/api/payments/abono/'+id, this.pago)
                .then(response=>{
                    this.getInfo()
                    this.getData()
                    this.pago.received_amount=0
                })
                .catch(error=>{
                    console.log(error)
                })
        }
    }
}
</script>