import axios from 'axios'

export default axios.create({
    baseURL: `http://192.168.15.12:3000/wp-json/fnwq/v1/`
})
