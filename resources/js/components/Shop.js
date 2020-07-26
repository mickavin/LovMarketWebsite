import React, { Component } from "react";
import ReactDOM from 'react-dom';
import SelectSearch from 'react-select-search';
import {getShops} from './ShopFunctions';

class Shop extends Component {
    constructor(props){
        super(props)
        this.state = {
            response : null,
            shops: null
        }
    }

    componentDidMount(){
        this.getAllShops()

    }

    responseShops = (response) => {
        console.log(response)
        const shops = response.map((item,index) =>
        {
            return {
            value: `${item.id}`,
            name: item.name
            }
        })
        this.setState({shops})
    }

    getAllShops = () => {
        getShops().then(data =>
            this.setState({response: [...data]},() =>
            {
                this.responseShops(this.state.response)
            }
            )
        )
    }

    render(){
        return(
            <SelectSearch
            search
            name={'shop'}
            placeholder={'Sélectionnez le commerce lié'}
            renderValue={(valueProps) =>
                <input {...valueProps}
                name={'shop'}
                className={'select-search__input'}
                autoComplete={'off'}
                />
            }
            options={this.state.shops}
            />
        )
    }
}

if (document.getElementById('select-shop')) {
    ReactDOM.render(<Shop />, document.getElementById('select-shop'));
}
