<template>
   <v-card>
        <v-data-table
            :headers="headers"
            :items="pagos"
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar flat color="white">
                    <v-toolbar-title><strong>Pagos y abonos</strong></v-toolbar-title>
                    <v-divider
                    class="mx-4"
                    inset
                    vertical
                    ></v-divider>
                    <v-spacer></v-spacer>
                    <v-btn
                    color="success"
                    class="mr-4"
                    @click="abonar"
                    >
                    Abonar
                    </v-btn>
                    <v-text-field
                    v-model="pago.received_amount"
                    type="number"
                    label="Abono"
                    required
                    ></v-text-field>
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
            pagos:[],
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
        abonar(){
            let id = this.$route.params.id
            axios.put('/api/payments/abono/'+id, this.pago)
                .then(response=>{
                    this.getInfo()
                    alert("Pagado")
                    this.pago.received_amount=0
                })
                .catch(error=>{
                    console.log(error)
                })
        }
    }
}
</script>