import './bootstrap';

import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';
import $ from 'jquery';

window.$ = window.jQuery = $;
window.Chart = Chart;
window.Alpine = Alpine;

Alpine.start();
