declare module '*.vue' {
    import { DefineComponent } from 'vue';
    const component: DefineComponent<{}, {}, any>;
    export default component;
}

declare module 'vue-axios' {
    export const install: (app: App, axios: AxiosStatic) => void
}
