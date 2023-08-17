<template>
  <v-app>
    <v-main>
       <FormSection/>
      <v-card>
        <HelloWorld/>
      </v-card>
    </v-main>
  </v-app>
</template>

<script>
import HelloWorld from './components/HelloWorld.vue'
import FormSection from './components/FormSection.vue'

export default {
  name: 'App',

  components: {
    HelloWorld,
    FormSection
  },

  data: () => ({
    //
  }),
}
</script>
