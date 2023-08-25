<template>
    <section class="section n4">
      <div class="container">
        <div class="n4-l">
          <div class="n4-l-t">
            Преимущества
          </div>
          <img src="../images/img_v2/n4-im1.svg" alt="" class="n4-l-c">
          <img src="../images/img_v2/n4-im2.svg" alt="" class="n4-l-b">
        </div>
        <div class="n4-r">
          <div class="n4-r-t">
            <li>Оплата только после трудоустройства</li>
            <li>Гарантийный период до 1-го года</li>
            <li>1 бесплатная замена в случае увольнения сотрудника</li>
          </div>
          <div class="n4-r-b">
            <div
              class="n4-r-b-row one"
              v-for="(item, index) in advantageBlocks"
              :key="index"
              @click="toggleBlock(index)"
              :class="{ acti: activeBlock === index }"
            >
              <div class="n4-r-b-l">{{ item.title }}</div>
              <div class="n4-r-b-r">
                <div class="n4-r-b-i1" v-show="activeBlock === index">{{ item.content }}</div>
                <img
                  src="../images/img_v2/n4-r-b-i2.svg"
                  alt=""
                  class="n4-r-b-i2"
                  :class="{ rotate: activeBlock === index }"
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </template>


<script>
export default {
  name: 'EdgeBl',
  data() {
    return {
      advantageBlocks: [
        {
          title: 'Компетентность',
          content:
            'Мы включаем участие наших экспертов высокого уровня в процесс отбора кандидатов. Это может быть финансовый директор, руководитель юридического направления, директор по персоналу или IT-директор, которые смогут оценить компетенции кандидатов и помочь вам найти того, кто идеально подходит для вашей компании.',
        },
        {
          title: 'Скорость',
          content:
            'Мы понимаем, что нахождение подходящего кандидата может занять много времени, в то время как бизнес будет терять деньги. Благодаря накопленной базе и опыту, мы можем закрывать даже сложные позиции в течение нескольких недель.',
        },
        {
          title: 'Оплата за результат',
          content:
            'Оплачивайте услугу после трудоустройства, без предоплаты и изменений стоимости.',
        },
        {
          title: 'Актуальность',
          content:
            'Отслеживаем все изменения законодательства в сфере трудового права и оперативно реагируем на изменения. Мы также постоянно анализируем вакансии, чтобы обеспечить вам всестороннюю информацию по рынку труда и дать возможность принимать оптимальные HR-решения.',
        },
        // Добавьте еще блоки по аналогии
      ],
      activeBlock: null,
    };
  },
  methods: {
    toggleBlock(index) {
      if (this.activeBlock === index) {
        this.activeBlock = null;
      } else {
        this.activeBlock = index;
      }
    

      const blocks = document.querySelectorAll('.n4-r-b-row');
      blocks.forEach((block, i) => {
        if (i === index) {
          block.classList.add('acti');
          block.querySelector('.n4-r-b-i2').classList.add('rotate');
          block.querySelector('.n4-r-b-i1').style.display = 'block';
        } else {
          block.classList.remove('acti');
          block.querySelector('.n4-r-b-i2').classList.remove('rotate');
          block.querySelector('.n4-r-b-i1').style.display = 'none';
        }
      });
    },
  },
};
</script>


<style scoped>
.acti {
  /* Стили для активного блока */
}

.rotate {
  /* Стили для поворота иконки */
  transform: rotate(180deg);
  transition: transform 0.3s ease; /* Добавлено свойство transition */
}

.n4-r-b-i1 {
  display: none;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.3s ease; /* Добавлено свойство transition */
}

.n4-r-b-row.acti .n4-r-b-i1 {
  max-height: 200px; /* Высота, на которую будет разворачиваться блок */
}
</style>