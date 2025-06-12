<script lang="ts">
import axios, {AxiosResponse} from 'axios'
import '@fortawesome/free-solid-svg-icons'
import {fas} from "@fortawesome/free-solid-svg-icons";
import {useMessage} from 'naive-ui'
import type {FormInst} from 'naive-ui'
import {ref, defineComponent} from 'vue'
import {Category} from '@/types/interfaces'
import router from "@/router";

export default defineComponent({
    setup() {
        return {
            formRules: {
                alert,
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
            categories: [] as Category[],
            //TODO: использовать enum пола
            sexList: {'male': 'Мужской', 'female': 'Женский'},
            alert: useMessage(),
            usersLimit: 2,
            formData: {
                formUserName: '',
                formSex: 'male',
            },
            formRef: ref<FormInst | null>(null)
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
            .catch((error) => {
                this.alert.error('Ошибка при получении категорий чатов: ' + error.response?.data.message)
            })
    },
    methods: {
        loadIcon(icon: any) {
            return fas[icon]
        },

        findChat(e: MouseEvent) {
            // TODO: однажды стоит разобраться с нативной валидацией формы у NaiveUI
            // Была бага с тем, что formRef.value являлся null'ом и не вызывал коллбек validation
            e.preventDefault()

            if (this.formData.formUserName === '') {
                this.alert.error('Введите никнейм')
                return;
            }

            let chosenCategoriesIds = [];
            for (const category of this.categories as Category[]) {
                if (category.chosen) {
                    chosenCategoriesIds.push(category.id);
                }
            }

            axios
                .get(
                    '/LobbiesController/findLobby',
                    {
                        params: {
                            nickname: this.formData.formUserName,
                            sex: this.formData.formSex,
                            categoriesIds: chosenCategoriesIds,
                            usersLimit: this.usersLimit,
                        },
                    }
                )
                .then((response: AxiosResponse) => {
                    //TODO: Переделать на константу
                    if (response.status === 200) {
                        router.push('/chat')
                    }
                })
                .catch((error) => {
                    this.alert.error('Ошибка при подключении к чату: ' + error.response?.data.message)
                })
        }
    }
})
</script>

<template>
    <div id="chat-choice">
        <h1>Найди свой чат</h1>
        <n-form
            ref="formRef"
            :model="formData"
            :rules="formRules"
            :label-width="80"
            :size="'large'"
            class="chat-choice-form"
        >
            <!-- Секция регистрации в чате -->
            <section>
                <div>
                    <div>
                        <n-form-item label="Ваш никнейм" path="formUserName">
                            <n-input v-model:value="formData.formUserName" placeholder="Никнейм">
                                <template #suffix>
                                    <n-popover trigger="hover">
                                        <template #trigger>
                                            <FontAwesomeIcon class="chat-choice-form__nickname-icon"
                                                             :icon="loadIcon('faQuestion')"/>
                                        </template>
                                        <span>Никнейм нужен только для чата, информация никуда не сохраняется.</span>
                                    </n-popover>
                                </template>
                            </n-input>
                        </n-form-item>
                    </div>
                    <div>
                        <n-radio-group name="radioGroup" v-model:value="formData.formSex">
                            <n-radio
                                v-for="(sex, key) in sexList"
                                :key="sex"
                                :label="sex"
                                :value="key"
                            />
                        </n-radio-group>
                    </div>
                    <div>
                        <n-form-item label="Максимальное кол-во пользователей в чате" path="usersLimit">
                            <n-input-number v-model:value="usersLimit" clearable :min="2" />
                        </n-form-item>
                    </div>
                </div>
            </section>

            <!-- Секция доп условий чата -->
            <section class="chat-choice-usersLimit">
            </section>

            <!-- Секция выбора категории чата -->
            <section class="chat-choice-categories">
                <div class="chat-category-wrapper">
                    <article
                        :class="[category.chosen ? 'chat-category-inner-chosen' : '', 'chat-category-inner']"
                        v-for="category in categories"
                        @click="category.chosen = !category.chosen"
                    >
                        <div class="chat-category__logo">
                            <FontAwesomeIcon :icon="loadIcon(category.logo)"/>
                        </div>
                        <div>{{ category?.title }}</div>
                    </article>
                </div>
            </section>

            <n-form-item>
                <n-button @click="findChat">Найти чат</n-button>
            </n-form-item>
        </n-form>
    </div>
</template>

<style scoped lang="scss">
.chat-category {
    &-wrapper {
        display: flex;
    }

    &-inner {
        cursor: pointer;
        padding: 30px 20px;
        box-sizing: border-box;

        &:hover {
            border-bottom: 2px solid #acacac;
        }

        &-chosen {
            border-bottom: 2px solid #222222;

            &:hover {
                border-bottom: 2px solid #777777;
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

.chat-choice {
    &-form {
        &__nickname {
            &-icon {
                margin-left: 15px;
            }
        }
    }

    &-wrapper {
        display: block;
    }
}
</style>
