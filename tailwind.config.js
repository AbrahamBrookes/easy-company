const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Almarai', ...defaultTheme.fontFamily.sans],
            },
			colors: {
				navy: {
					'50':  '#f4f8fa',
					'100': '#ddf0fb',
					'200': '#b6def7',
					'300': '#86beeb',
					'400': '#549adb',
					'500': '#4077cc',
					'600': '#355cb7',
					'700': '#2b4594',
					'800': '#1f2f6b',
					'900': '#121d45',
				},
				blue: {
					'50':  '#f7fafb',
					'100': '#e3f1fd',
					'200': '#c5d9fb',
					'300': '#9cb6f5',
					'400': '#788eed',
					'500': '#6168e7',
					'600': '#4f4cda',
					'700': '#3c38bb',
					'800': '#2a268d',
					'900': '#171859',
				},
				indigo: {
					'50':  '#f9fafb',
					'100': '#edeffb',
					'200': '#dad4f8',
					'300': '#baaeef',
					'400': '#a485e3',
					'500': '#8c60da',
					'600': '#7344c9',
					'700': '#5733a6',
					'800': '#3c2377',
					'900': '#221748',
				},
				cerise: {
					'50':  '#fdfcfa',
					'100': '#fbf0ec',
					'200': '#f8ced8',
					'300': '#efa1b2',
					'400': '#ec7088',
					'500': '#e14c67',
					'600': '#cb3348',
					'700': '#a42635',
					'800': '#781b23',
					'900': '#4a1113',
				},
				purple: {
					'50':  '#fbfbfb',
					'100': '#f5eef8',
					'200': '#eccdf3',
					'300': '#daa4e3',
					'400': '#d378d1',
					'500': '#c154c3',
					'600': '#a739aa',
					'700': '#812b85',
					'800': '#5b1f5a',
					'900': '#361433',
				},
				cocoa: {
					'50':  '#fcfbf8',
					'100': '#fbf0dd',
					'200': '#f6d6b8',
					'300': '#e8ac86',
					'400': '#de7d58',
					'500': '#ca5b36',
					'600': '#ae4023',
					'700': '#87301c',
					'800': '#5e2114',
					'900': '#3b140d',
				},
				yellow: {
					'50':  '#faf9f0',
					'100': '#f8ef9e',
					'200': '#eee15a',
					'300': '#d2c032',
					'400': '#a39818',
					'500': '#7e7b0a',
					'600': '#646307',
					'700': '#4e4b07',
					'800': '#353307',
					'900': '#251f06',
				},
				lemon: {
					'50':  '#fbfaf3',
					'100': '#f8f0b4',
					'200': '#f0de75',
					'300': '#d9bb45',
					'400': '#b69124',
					'500': '#957211',
					'600': '#78590b',
					'700': '#61410c',
					'800': '#3f2e09',
					'900': '#2a1c07',
				},
				emerald: {
					'50':  '#ecf4f2',
					'100': '#c9f0ed',
					'200': '#8de9d5',
					'300': '#51d1aa',
					'400': '#1ab57a',
					'500': '#129c50',
					'600': '#10883c',
					'700': '#116931',
					'800': '#0d4827',
					'900': '#0a2c1f',
				},
				submarine: {
					'50':  '#eff6f5',
					'100': '#d0f0f4',
					'200': '#9be6e6',
					'300': '#61cbc8',
					'400': '#27aca2',
					'500': '#1c907c',
					'600': '#197963',
					'700': '#175d4d',
					'800': '#123f39',
					'900': '#0c272a',
				},
			},
        },
    },
};
