import '../public/css/app.css';
import { app } from '@storybook/vue3';
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