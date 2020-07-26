import React, { Component } from "react";
import ReactDOM from 'react-dom';

class Drop extends Component {
    constructor(props){
        super(props)
        this.state = {
            isChecked : props.value ? true : false,
            value: ""
        }
        console.log(props)
    }

    toggleChange = () => {
        this.setState({
          isChecked: !this.state.isChecked,
        });
      }

      updateInput = (price) => {
        this.setState({value: price});
    }


    render(){
        return(
            <div>
                <div className="form-check mb-3 offset-sm-2">
                    <input name="isChecked" type="checkbox" checked={this.state.isChecked} onChange={this.toggleChange} className="form-check-input" id="isdrop"/>
                    <label className="form-check-label" htmlFor="isdrop">Ajouter une promotion sur ce produit</label>
                </div>

                <div className="position-relative row form-group mb-4"><label htmlFor="nouveau_prix" className="col-sm-2 col-form-label">Nouveau prix</label>
                    <div className="col-sm-10 col-lg-6">
                    {
                        this.state.isChecked ?
                        <input
                        onChange={e => this.updateInput(e.target.value)}
                        value={ this.state.value ? this.state.value : this.props.value}
                        name="nouveau_prix"
                        id="nouveau_prix"
                        placeholder="Nouveau prix"
                        type="text"
                        className="form-control"/>
                        :
                        <input value="" name="nouveau_prix" id="nouveau_prix" placeholder="Nouveau prix" type="text" className="form-control" disabled/>
                    }
                    {
                        this.props.errors ?
                        <span className="help-block text-danger">{this.props.errors}</span>
                        : null
                    }
                    <small className="form-text text-muted">Exemple: 0.90</small>
                    </div>
                </div>
            </div>
        )
    }
}

if (document.getElementById('drop')) {
    const element = document.getElementById('drop');
    const props = Object.assign({}, element.dataset);
    ReactDOM.render(<Drop {...props}/>, element);
}
