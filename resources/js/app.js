import './bootstrap';
import comments from './alpine/comments';

import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.data('comments',comments);

Alpine.start()