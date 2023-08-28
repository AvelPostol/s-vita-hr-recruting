

<template>
 <section class="section s4">
    <div class="container">
        <div class="s4-by" >
            <div class="s4-rowy" v-for="(item, index) in items" :key="index">
                <div class="s4-coly">
                    <div class="s4-l">
                           {{ item.title }} <span v-if="item.subspan">{{ item.subspan }}</span>
                    </div> 
                    <div class="s4-r">
                        {{ item.content }} 
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

  </template>
  

  <script>
  export default {
    name: 'LentBtn',
  data() {
      return {
        items: [
          {
            title: '100+',
            content: 'Довольных клентов',
          },
            {
            title: '95%',
            content: ' Клиентов работают с нами на постоянной основе',
          },
            {
            title: '100',
            content: 'Успешных кейсов по рекрутингу',
          },
            {
            title: '10',
            content: 'Средний стаж работы  консультантов в компании',
            subspan: 'лет',
          },
        ],

      };
    },
  };
  </script>
  