import React, { Component } from "react";
import ReactDOM from 'react-dom';
import SelectSearch from 'react-select-search';
import {getShops} from './ShopFunctions';

class SearchShop extends Component {
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
            <div>
                <div className="position-relative row form-group mb-4"><label htmlFor="input" className="col-sm-2 col-form-label">Commerce</label>
                    <div className="col-sm-10 col-lg-6">
                    <SelectSearch
                    search
                    name={'shop'}
                    placeholder={'Sélectionnez un commerce'}
                    renderValue={(valueProps) =>
                        <input {...valueProps}
                        name={'shop'}
                        className={'select-search__input'}
                        autoComplete={'off'}
                        />
                    }
                    options={this.state.shops}
                    />
                    </div>
                </div>
                <div className="position-relative row form-check mt-3">
                        <div className="col-sm-10 col-lg-6 offset-sm-2">
                            <button className="btn btn-primary">Accéder à ce commerce</button>
                        </div>
                </div>
            </div>
        )
    }
}

if (document.getElementById('search-shop')) {
    ReactDOM.render(<SearchShop />, document.getElementById('search-shop'));
}
