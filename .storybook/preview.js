import '../public/css/app.css';
import { app } from '@storybook/vue3';

import Link from '@/Components/Link.vue';

export const parameters = {
  actions: { argTypesRegex: "^on[A-Z].*" },
  controls: {
    matchers: {
      color: /(background|color)$/i,
      date: /Date$/,
    },
  },
}

app.mixin({
	methods: {
		route: (name) => name ? '#' : { current: () => !!Math.round(Math.random()), },
	}
});

app.component(Link)
