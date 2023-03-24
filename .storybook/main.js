const path = require('path');

module.exports = {
  "stories": [
    "../stories/**/*.stories.mdx",
    "../stories/**/*.stories.@(js|jsx|ts|tsx)"
  ],
  "addons": [
    "@storybook/addon-links",
    "@storybook/addon-essentials",
    "@storybook/addon-interactions"
  ],
  "framework": "@storybook/vue3",
  "core": {
    "builder": "@storybook/builder-webpack5"
  },
  "webpackFinal": async (config) => {
    config.resolve.alias['@'] = path.resolve(__dirname, '../resources/js');
    config.resolve.alias['fixtures'] = path.resolve(__dirname, '../stories/Fixtures');
    return config;
  },
}
