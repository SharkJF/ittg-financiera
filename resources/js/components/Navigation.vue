<template>
    <v-list>
        <v-list-item dark to="/">
            <v-list-item-icon>
                <v-icon>mdi-vpn-key</v-icon>
            </v-list-item-icon>
            <v-list-item-title><strong>Home</strong></v-list-item-title>
        </v-list-item>
        <v-list-item dark to="/">
            <v-list-item-icon>
                <v-icon>mdi-home</v-icon>
            </v-list-item-icon>
            <v-list-item-title><strong>Home</strong></v-list-item-title>
        </v-list-item>
        <v-list-item dark to="/clients">
             <v-list-item-icon>
                <v-icon>mdi-account-circle</v-icon>
            </v-list-item-icon> 
            <v-list-item-title><strong>Clientes</strong></v-list-item-title>
        </v-list-item>
        <v-list-item dark to="/loans">
            <v-list-item-icon>
                <v-icon>mdi-cash-multiple</v-icon>
            </v-list-item-icon>
            <v-list-item-title><strong>Prestamos</strong></v-list-item-title>
        </v-list-item>
        <v-list-item dark to="/payments">
            <v-list-item-icon>
                <v-icon>mdi-chart-areaspline</v-icon>
            </v-list-item-icon>
            <v-list-item-title><strong>Pagos</strong></v-list-item-title>
        </v-list-item>
        <v-list-item dark to="/about">
             <v-list-item-icon>
                <v-icon>mdi-information</v-icon>
            </v-list-item-icon> 
            <v-list-item-title><strong>About</strong></v-list-item-title>
        </v-list-item>
    </v-list>
</template>
