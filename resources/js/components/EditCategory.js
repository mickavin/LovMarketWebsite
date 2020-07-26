import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import {editCatProd} from './ShopFunctions';

class EditCategory extends Component {
    constructor(props){
        super(props)
        this.state = {
            isInput: false
        }
    }

    onClick = () => {
        this.setState({ isInput : true} );
     }

     onUpdate = (e) =>{
         e.preventDefault();
         editCatProd(this.props.category,this.props.id)
         this.setState({isInput:false})
     }
    render(){
        return(
            <tr>
                <td className="text-muted">#
                    id
                </td>
                <td>
                    <div className="widget-content p-0">
                        <div className="widget-content-wrapper">
                            <div className="widget-content-left">
                            </div>
                            <div className="widget-content-left flex2">
                                <div className="widget-heading">
                                    name
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <a className="btn btn-primary btn-sm" onClick={this.onClick} style="color: #fff">Modifier</a>
                </td>
            </tr>
        )
    }
}

export default EditCategory;

if (document.getElementById('edit-category')) {
    const element = document.getElementById('edit-category');
    const props = Object.assign({}, element.dataset);
    ReactDOM.render(<EditCategory {...props}/>, element);
}

