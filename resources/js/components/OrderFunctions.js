import axios from 'axios';

export const getAdminStateOrders = () => {
    return axios
    .get('/coom/public/api/admin/orders',{
        headers: {'Content-Type': 'application/json'}
    })
    .then(res => {
        return res.data
    })
    .catch(error => console.log(error))
}

export const getStateOrders = () => {
    return axios
    .get('/coom/public/api/orders',{
        headers: {'Content-Type': 'application/json'}
    })
    .then(res => {
        return res.data
    })
    .catch(error => console.log(error))
}
