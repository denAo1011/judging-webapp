// Vuetify
import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";

import "@mdi/font/css/materialdesignicons.css";
import { md1 } from "vuetify/blueprints";
import "../../css/style.scss";

const vuetify = createVuetify({
    blueprint: md1,
    components,
    directives,
    icons: {
        defaultSet: "mdi",
    },
});

export default vuetify;
