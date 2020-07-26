import axios from 'axios';

export const getShops = () => {
    return axios
    .get('/coom/public/api/shops',{
        headers: {'Content-Type': 'application/json'}
    })
    .then(res => {
        return res.data
    })
    .catch(error => console.log(error))
}


export const editCatProd = (category,id) => {
    return axios
    .put(`/coom/public/api/categoryprod/${id}`,
    {
        category
    },
    {
        headers: {'Content-Type': 'application/json'}
    })
    .then(res => {
        console.log(res)
    })
    .catch(error => console.log(error))
}
