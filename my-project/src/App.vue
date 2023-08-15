<template>
  <v-app>
    <v-main>
      <v-card>
        <HelloWorld/>
      </v-card>
    </v-main>
  </v-app>
</template>

<script>
import HelloWorld from './components/HelloWorld.vue'

export default {
  name: 'App',

  components: {
    HelloWorld,
  },

  data: () => ({
    //
  }),
}
</script>
