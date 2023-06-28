import axios from 'axios';

const apiToken = document.querySelector('meta[name="api-token"]').getAttribute('content');

axios.defaults.headers.common['Authorization'] = `Bearer ${apiToken}`;