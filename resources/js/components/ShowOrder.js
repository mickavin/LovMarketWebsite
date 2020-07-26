import React, { Component } from "react";
import ReactDOM from 'react-dom';
import {database} from '../firebase';

class ShowOrder extends Component {
    constructor(props){
        super(props)
        this.state = {
           orders: []
        }
        this.orders = database.ref(`purchaseHistory`);
    }

    componentDidMount(){
        console.log(this.props.orderid)
        this.orders.orderByChild('id').equalTo(parseInt(this.props.orderid)).once("value", snap => {
            let orders = [];
            snap.forEach((row,index) => {
                orders.push(row.val())
            });
            console.log(orders)
            this.setState({orders:orders[0]})
        });

    }



    render(){
        if(this.state.orders.cart !== undefined){
        return(
            <div className="table-responsive">
            <table className="align-middle mb-0 table table-borderless table-striped table-hover">
                <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix vendu</th>
                    <th>Quantité</th>
                    <th>Prix total</th>
                </tr>
                </thead>
                <tbody>
                { this.state.orders.cart.map((item, index) =>
                    <tr
                    key={index}
                    >
                    <td>
                    <div className="widget-content">
                        <div className="widget-content-wrapper">
                            <div className="widget-content-left mr-3">
                                <div className="widget-content-left">
                                    <img width="100" src={item.image} alt={item.name}/>
                                </div>
                            </div>
                            <div className="widget-content-left flex2">
                                <div className="widget-heading">{item.name}</div>
                            </div>
                        </div>
                    </div>
                    </td>
                    <td>
                        {item.new_price ?
                        item.new_price :
                        item.price} €
                    </td>
                    <td>
                        {item.units}
                    </td>
                    <td>
                        {item.new_price ?
                        (item.new_price*item.units).toFixed(2) :
                        (item.price*item.units).toFixed(2)} €
                    </td>
                    </tr>
                )}
                </tbody>
                </table>
            </div>
        )} else {
            return (
            <div></div>
            )
        }
    }
}

if (document.getElementById('ShowOrder')) {
    const element = document.getElementById('ShowOrder');
    const props = Object.assign({}, element.dataset);
    ReactDOM.render(<ShowOrder {...props}/>, element);
}
