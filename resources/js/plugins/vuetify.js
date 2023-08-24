// Vuetify
import "vuetify/styles";
import { createVuetify  } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";

import "@mdi/font/css/materialdesignicons.css";
import { md1 } from "vuetify/blueprints";
import "../../css/style.scss";
import 'aos/dist/aos.css';

const vuetify = createVuetify({
    blueprint: md1,
    components,
    directives,
    icons: {
        defaultSet: "mdi",
    },
    theme: {
        defaultTheme: 'myCustomTheme',
        themes: {
            myCustomTheme: {
              dark: false,
              colors: {
                primary: '#EA2E28',
                'primary-light': '#F26E6A5',
                tertiary: '#B7F1A5',
                fourth: '#1435B4',
                error: '#B00020',
                info: '#2196F3',
                success: '#4CAF50',
                warning: '#FB8C00',
              },
            },
          },
    },
});

export default vuetify;
