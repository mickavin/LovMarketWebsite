import React, { Component } from "react";
import ReactDOM from 'react-dom';
import {storage} from '../firebase';
import FileUploader from "react-firebase-file-uploader";

class Image extends Component {
    constructor(props){
        super(props)
        this.state = {
            image: "",
            isUploading: false,
            progress: 0,
            imageURL: "",
            value: ""
        }
    }

    handleUploadStart = () => this.setState({ isUploading: true, progress: 0 });
    handleProgress = progress => this.setState({ progress });
    handleUploadError = error => {
        this.setState({ isUploading: false });
        console.error(error);
    };
    handleUploadSuccess = filename => {
        this.setState({ image: filename, progress: 100, isUploading: false });
        storage
        .ref("images")
        .child(filename)
        .getDownloadURL()
        .then(url => this.setState({ imageURL: url }))
        .catch(( error ) => {
        console.log(error);
        });
    };

    updateInput = (event) => {
        this.setState({value: event.target.value});
    }

    getWidth = () => {
        if(this.props.img == 'product'){
            return 50;
        } else {
            return 320;
        }
    }

    getHeight = () => {
        if(this.props.img == 'product'){
            return 50;
        } else {
            return 240;
        }
    }

    render(){
        return (
            <div className="position-relative row form-group">
            <label htmlFor="image" className="col-sm-2 col-form-label">Image</label>
                <div className="col-sm-10 col-lg-6 image">
                { this.props.image || this.state.imageURL ?
                <img style={{height:"80px"}}
                src={this.props.image && !this.state.imageURL ? this.props.image : this.state.imageURL}
                />
                : null
                }
                {
                    this.state.isUploading && <p>Progression: {this.state.progress}</p>
                }
                {
                this.props.img == 'product' ?
                <FileUploader
                accept="image/png, image/jpeg"
                className="form-control-file"
                id="image"
                name="image"
                randomizeFilename
                storageRef={storage.ref("images")}
                onUploadStart={this.handleUploadStart}
                onUploadError={this.handleUploadError}
                onUploadSuccess={this.handleUploadSuccess}
                onProgress={this.handleProgress}
                maxWidth={200}
                maxHeight={200}
                />
                :
                <FileUploader
                accept="image/png, image/jpeg"
                className="form-control-file"
                id="image"
                name="image"
                randomizeFilename
                storageRef={storage.ref("images")}
                onUploadStart={this.handleUploadStart}
                onUploadError={this.handleUploadError}
                onUploadSuccess={this.handleUploadSuccess}
                onProgress={this.handleProgress}
                maxWidth={320}
                maxHeight={240}
                />
                }
                <input
                type="hidden"
                id="hidden"
                onChange={this.updateInput}
                name="img"
                value={ this.props.image && !this.state.imageURL ? this.props.image : this.state.imageURL }
                required/>
                {
                    this.props.error ?
                    <span className="help-block text-danger">{this.props.error}</span>
                    : null
                }
            </div>
            </div>
        );
    }
}

export default Image;

if (document.getElementById('img')) {
    const element = document.getElementById('img');
    const props = Object.assign({}, element.dataset);
    ReactDOM.render(<Image {...props}/>, element);
}
