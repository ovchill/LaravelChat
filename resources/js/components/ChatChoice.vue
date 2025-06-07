<script lang="ts">
import axios from 'axios'
import '@fortawesome/free-solid-svg-icons'
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {fas} from "@fortawesome/free-solid-svg-icons";
import { useMessage } from 'naive-ui'
import FormInst from 'naive-ui'
import { ref, defineComponent } from 'vue'

export default defineComponent({
    setup() {
        return {
            formRef: ref(null),
            formRules: {
                formUserName: {
                    required: true,
                    message: 'Пожалуйста, введите ваш никнейм или имя.',
                    trigger: ['input', 'blur'],
                }
            },
        }
    },
    data() {
        return {
            categories: Array<{ title: string; logo: string; chosen: boolean }>,
            sexList: ['Мужской', 'Женский'],
            formData: {
                formUserName: '',
                formSexId: 0,
            },
            alert: useMessage(),
        }
    },
    mounted() {
        axios
            .get('/CategoriesController/getCategoriesForFront')
            .then((response) => {
                let categoriesFromApi = response.data

                for (let index = 0; index < categoriesFromApi.length; index++) {
                    categoriesFromApi[index].chosen = false
                }

                this.categories = categoriesFromApi
            })
    },
    methods: {
        fas() {
            return fas
        },
        findChat() {
            // e.preventDefault()
            // console.log(this.formRef)
            // console.log('this.formRef.value')
            // console.log(this.formRef?.value)
            // this.formRef?.value?.validate((errors) => {
            //     console.log('errors')
            //     console.log(errors)
            //     if (!errors) {
            //         router.push({
            //             'path': '/chat',
            //         });
            //     }
            //     else {
            //         alert.error('Invalid')
            //     }
            // })
        }
    }
})
</script>

<template>
    <div id="chat-choice">
        <n-form
            ref="formRef"
            inline
            :model="formData"
            :rules="formRules"
            :label-width="80"
            :size="'large'"
        >
            <!-- Секция регистрации в чате -->
            <section>
                <article>Поля для регистрации в чате</article>
                <div>
                    <n-form-item label="Ваш никнейм" path="formUserName">
                        <n-input v-model="formData.formUserName" placeholder="Никнейм" />
                    </n-form-item>
                    <n-radio-group name="radioGroup" v-model:value="formData.formSexId">
                        <n-radio
                            v-for="(sex, index) in sexList"
                            :key="sex"
                            :label="sex"
                            :value="index"
                        />
                    </n-radio-group>
                </div>
            </section>

            <!-- Секция выбора чата -->
            <section>
                <div class="chat-category-wrapper">
                    <article
                        :class="[category.chosen ? 'chat-category-inner-chosen' : '', 'chat-category-inner']"
                        v-for="category in categories"
                        @click="category.chosen = !category.chosen"
                    >
                        <div class="chat-category__logo">
                            <FontAwesomeIcon :icon="fas()[category?.logo]" />
                        </div>
                        <div>{{ category?.title }}</div>
                    </article>
                </div>
            </section>

            <n-button @click="findChat">Найти чат</n-button>
        </n-form>
    </div>
</template>

<style scoped lang="scss">
.chat-category {
    &-wrapper {
        display: flex;
        justify-content: space-between;
    }

    &-inner {
        cursor: pointer;
        transition: all, .5s;
        padding: 30px 20px;

        &:hover {
            background: #dbffbb;
        }

        &-chosen {
            background: #c7f89b;

            &:hover {
                background: #a8ca8b;
            }
        }
    }

    &__logo {
        img {
            width: 50px;
            height: 50px;
        }
    }
}
</style>
