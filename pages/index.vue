<template>
   <v-app class="extra-app-class">
    <v-main>
       <MainBlock />
       <ViaContent/>
       <MobailSlider/>
       <LentBtn/>
       <CaseSlider/>
       <WhyTrust/>
       <EdgeBl/>
       <LentForm/>
       <HowWork/>
       <NashaComanda/>
       <VacansyTo/>
       <NashiPartneru/>
       <EndFooter/>
    </v-main>
    <FormSection />
  </v-app>
</template>

<script>
import MainBlock from '~/components/MainBlock.vue';
import FormSection from '~/components/FormSection.vue';

import ViaContent from '~/components/ViaContent.vue';
import MobailSlider from '~/components/MobailSlider.vue';
import LentBtn from '~/components/LentBtn.vue';
import CaseSlider from '~/components/CaseSlider.vue';

import WhyTrust from '~/components/WhyTrust.vue';
import EdgeBl from '~/components/EdgeBl.vue';
import LentForm from '~/components/LentForm.vue';

import HowWork from '~/components/HowWork.vue';
import OtzMain from '~/components/OtzMain.vue';
import NashiPartneru from '~/components/NashiPartneru.vue';

import EndFooter from '~/components/EndFooter.vue';

import NashaComanda from '~/components/NashaComanda.vue';
import VacansyTo '~/components/VacansyTo.vue';


export default {

  components: {
    MainBlock,
    FormSection,
    ViaContent,
    MobailSlider,
    LentBtn,
    CaseSlider,
    WhyTrust,
    EdgeBl,
    LentForm,
    HowWork,
    NashaComanda,
    NashiPartneru,
    EndFooter,
    VacansyTo
  },

};
</script>

<style>
  .extra-app-class{
    z-index: 0;
  }

</style>
