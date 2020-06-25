<template>
    <v-form
    ref="form"
    v-model="valid"
    lazy-validation
  >
    <v-text-field
      v-model="name"
      :rules="nameRules"
      label="Name"
      required
    ></v-text-field>

    <v-text-field
      v-model="email"
      :rules="emailRules"
      label="E-mail"
      value="hola"
      required
    ></v-text-field>
    </v-form>
</template>
<script>
  export default {
    mounted(){
        this.getUser()
    },
    data: () => ({
      valid: true,
      name: '',
      nameRules: [
        v => !!v || 'Name is required',
      ],
      email: '',
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],
      userInfo:[],
    }),


    methods: {
      validate () {
        this.$refs.form.validate()
      },
      getUser(){
          axios.get('/api/info')
            .then(response=>{
                this.userInfo = response.data
                this.name = userInfo.name
                console.log(this.userInfo)
               })
                .catch(error=>{
                    console.log(error)
                })
      }
    },
  }
</script>