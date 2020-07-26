import React, { Component } from "react";
import ReactDOM from 'react-dom';
import {database} from '../firebase';
import ReactPaginate from 'react-paginate';
import {getAdminStateOrders} from './OrderFunctions';

class AdminOrders extends Component {
    constructor(props){
        super(props)
        this.state = {
           value: '',
           orders: [],
           data: [],
           states: [],
           search: [],
           ordersByState: [],
           active: null,
           count: null
        }
        this.pageSize = 40;
        this.orders = database.ref(`purchaseHistory`);
        this.searchedOrders = [];
        this.ordersByState = [];
        this.states = [];
    }

    componentDidMount(){
        this.orders.on("value", snap => {
            let data = [];
            snap.forEach((row,index) => {
                data.push(row.val())
            });
            this.setState({
                data: data.reverse(),
                count: data.length/this.pageSize
            },() => {
            const orders = this.state.data.slice(0, this.pageSize)
            this.setState({
                orders
            })
            })
        });
        getAdminStateOrders().then(states => this.setState({states}))
    }

    componentWillUnmount(){
        this.orders.off("value", snap => {
            let data = [];
            snap.forEach((row,index) => {
                data.push(row.val())
            });
            this.setState({
                data: data.reverse(),
                count: data.length/this.pageSize
            },() => {
            const orders = this.state.data.slice(0, this.pageSize)
            this.setState({
                orders
            })
            })
        });
    }

    loadOrders = (ordersByState = []) => {
        if(this.state.value.length > 0){
          for(var i = 0; i < this.state.data.length; i++){
            if(this.state.data[i].id.toString().indexOf(this.state.value) > -1 ||
            this.state.data[i].userId.toString().indexOf(this.state.value) > -1 ||
            this.state.data[i].shopId.toString().indexOf(this.state.value) > -1
            ){
              this.searchedOrders = [...this.searchedOrders, this.state.data[i]];
            }
          }
          if(this.searchedOrders.length > 0 && ordersByState.length == 0){
            this.setState({
                search: this.searchedOrders,
                orders: this.searchedOrders.slice(0, this.pageSize),
                count: this.searchedOrders.length/this.pageSize
              })
          } else if(this.searchedOrders.length > 0 && ordersByState.length > 0){
            this.searchedOrders = this.searchedOrders.filter(value => ordersByState.includes(value))
            this.setState({
                search: this.searchedOrders,
                orders: this.searchedOrders.slice(0, this.pageSize),
                count: this.searchedOrders.length/this.pageSize
              })
          } else if(this.searchedOrders.length == 0 && ordersByState.length > 0){
            this.setState({
                search: ordersByState,
                orders: ordersByState.slice(0, this.pageSize),
                count: ordersByState.length/this.pageSize
            })
          } else {
            this.setState({
                search: ordersByState,
                orders: ordersByState.slice(0, this.pageSize),
                count: ordersByState.length/this.pageSize
            })
          }
        } else if (ordersByState.length > 0 && this.state.value.length == 0) {
            this.setState({
                search: ordersByState,
                orders: ordersByState.slice(0, this.pageSize),
                count: ordersByState.length/this.pageSize
            })
        } else {
            this.setState({
                search: ordersByState,
                orders: ordersByState.slice(0, this.pageSize),
                count: ordersByState.length/this.pageSize
            })
          }
      }

    changeHandler = event => this.setState({
    value: event.target.value
    })

    clearSearch = () => {
        this.setState({
            orders: this.state.data.slice(0, this.pageSize),
            count: this.state.data.length/this.pageSize,
            search: [],
            value: '',
            active: null
        })
        this.searchedOrders = []
    }

    searchOrders = (ordersByState = []) => {
        this.searchedOrders = [];
        this.setState({
          orders: this.state.data.slice(0, this.pageSize),
          search: []
        }, () => {
            this.loadOrders(ordersByState || [])
        })
      }

    getOrder = (page) => {
        if(this.state.search.length > 0 && this.state.count > 1){
            const orders = this.state.search.slice(
                page.selected*this.pageSize,
                (page.selected + 1)*this.pageSize)
            this.setState({orders})
        } else {
            const orders = this.state.data.slice(
                page.selected*this.pageSize,
                (page.selected + 1)*this.pageSize)
            this.setState({orders})
        }
    }

    getDate = (timestamp) => {
        const d = new Date(timestamp);
        const ds = d.toLocaleString();
        return ds;
    }

    getState = (id) => {
        const state = this.state.states.filter(item => item.order_id == id);

        if(state[0] !== undefined){
            if(state[0].is_prepared == 1 && state[0].is_delivered == 0){
                return (
                    <div className="badge badge-warning">À livrer</div>
                )
            } else if (state[0].is_delivered == 1) {
                return (
                    <div className="badge badge-success">Livrée</div>
                )
            } else {
                return (
                    <div className="badge badge-primary">À préparer</div>
                )
            }
        } else {
            return (
                <div className="badge badge-primary">À préparer</div>
            )
        }
    }

    getOrdersByState = state => {
        this.ordersByState = []
        if(state == 1){
            this.setState({active: 1})
            this.states = this.state.states;
        } else if (state == 2){
            this.setState({active: 2})
            this.states = this.state.states.filter(item =>
                item.is_delivered == 0 && item.is_prepared == 0
            )
        } else if (state == 3){
            this.setState({active: 3})
            this.states = this.state.states.filter(item =>
                item.is_delivered == 0 && item.is_prepared == 1
            )
        } else if (state == 4){
            this.setState({active: 4})
            this.states = this.state.states.filter(item =>
                item.is_delivered == 1
            )
        }
        for(var i = 0; i < this.state.data.length; i++){
            const id = this.states.findIndex(data => data.order_id == this.state.data[i].id)
            if(id > -1){
                this.ordersByState = [...this.ordersByState, this.state.data[i]]
            }
        }
        this.searchOrders(this.ordersByState)
    }

    render(){
        return(
            <div className="row">
            <div className="col-md-12">
                <div className="main-card mb-3 card">
                    <div className="card-header">Liste des commandes
                    <div className="btn-group btn-group-sm ml-auto mr-auto" role="group">
                        <button
                        id="1"
                        type="button"
                        className={
                            this.state.active == 1 ?
                            "btn btn-outline-secondary active" :
                            "btn btn-outline-secondary"
                        }
                        onClick={() => this.getOrdersByState(1)}>
                        Toutes</button>
                        <button
                        id="2"
                        type="button"
                        className={
                            this.state.active == 2 ?
                            "btn btn-outline-secondary active" :
                            "btn btn-outline-secondary"
                        }                        onClick={() => this.getOrdersByState(2)}>
                        À préparer</button>
                        <button
                        id="3"
                        type="button"
                        className={
                            this.state.active == 3 ?
                            "btn btn-outline-secondary active" :
                            "btn btn-outline-secondary"
                        }
                        onClick={() => this.getOrdersByState(3)}>
                        À livrer</button>
                        <button
                        id="4"
                        type="button"
                        className={
                            this.state.active == 4 ?
                            "btn btn-outline-secondary active" :
                            "btn btn-outline-secondary"
                        }
                        onClick={() => this.getOrdersByState(4)}>
                        Livrée</button>
                    </div>
                    <div className="ml-auto">
                        <div className="input-group">
                            <input
                            type="text"
                            className="form-control"
                            placeholder="Rechercher"
                            name="name"
                            value={this.state.value}
                            onChange={this.changeHandler}
                            />
                            <button
                            className="btn bg-transparent"
                            style={{ marginLeft: '-34px', zIndex: 100 }}
                            onClick={this.clearSearch}>
                            <i className="fa fa-times"></i>
                            </button>
                            <div className="input-group-append">
                                <button
                                className="btn btn-outline-secondary"
                                onClick={() => this.searchOrders()}>Rechercher</button>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div className="table-responsive">
                        <table className="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th>N° de commande</th>
                                <th>Id Client</th>
                                <th>Id Commerçant</th>
                                <th>Date</th>
                                <th>Actions</th>
                                <th>État</th>
                            </tr>
                            </thead>
                            <tbody>
                            {
                                this.state.orders.map((item, index) =>
                                <tr key={index}>
                                    <td>
                                        {item.id}
                                    </td>
                                    <td>
                                        {item.userId}
                                    </td>
                                    <td>
                                        {item.shopId}
                                    </td>
                                    <th>
                                        {this.getDate(item.timestamp)}
                                    </th>
                                    <th>
                                        <a
                                        href={`commande/${item.id}`}
                                        className={'btn btn-primary'}>
                                        Voir la commande
                                        </a>
                                    </th>
                                    <th>
                                        {this.getState(item.id)}
                                    </th>
                                </tr>
                                )
                            }
                            </tbody>
                        </table>
                    </div>
                    { this.state.count > 1 ?
                    <div className="d-block text-center card-footer">
                    <ReactPaginate
                    previousLabel={'Précédent'}
                    nextLabel={'Suivant'}
                    breakLabel={'...'}
                    breakClassName={'break-me'}
                    pageCount={Math.round(this.state.count)}
                    marginPagesDisplayed={2}
                    pageRangeDisplayed={5}
                    onPageChange={this.getOrder}
                    containerClassName={'pagination justify-content-center'}
                    subContainerClassName={'pages pagination'}
                    activeClassName={'active'}
                    />
                    </div>
                    : null
                    }
                </div>
            </div>
        </div>

        )
    }
}

if (document.getElementById('AdminOrders')) {
    const element = document.getElementById('AdminOrders');
    const props = Object.assign({}, element.dataset);
    ReactDOM.render(<AdminOrders {...props}/>, element);
}
