import React, { Component, Fragment} from "react";
import { Link,Redirect } from "react-router-dom";
import PropTypes from 'prop-types';
import {connect} from 'react-redux';
import Modal from 'react-modal'; 
import {logoutUser} from '../../actions/authActions';
import {clearProfile} from '../../actions/profileAction';
import {changeCentral} from '../../actions/profileAction';
import { getCategories } from '../../actions/categoryAction';
import { proCategory } from '../../actions/categoryAction';
import { getStorage } from '../../actions/storageAction';
import { getWarhouse } from '../../actions/storageAction';
import { getSearch } from '../../actions/searchAction';
import { getProduct, unmountProduct } from '../../actions/productAction';
import Anchor from '../common/Anchor'
import Search from "../product/Search.js";
import logo from '../../img/logo.png';
class Navbar extends React.Component {
    constructor() {
        super();    
        this.state = {
          modalIsOpen: false,
          storage: "",
          search:"",
          errors: {}
        } 
        this.openModal = this.openModal.bind(this);
        this.afterOpenModal = this.afterOpenModal.bind(this);
        this.closeModal = this.closeModal.bind(this);
        this.onChange = this.onChange.bind(this);
        this.search = this.search.bind(this);        
        this.ChangeSearch = this.ChangeSearch.bind(this);        
        this.onSubmit = this.onSubmit.bind(this);
      }
    componentDidMount() {
        this.props.getCategories();
        this.props.getStorage();
        this.props.getWarhouse();
        this.props.getSearch();
        this.props.getProduct();
        this.props.proCategory();
        window.addEventListener('scroll', this.handleScroll);
    }    
    componentWillUnmount() {
        window.removeEventListener('scroll', this.handleScroll);
        /* Modal.setAppElement('body'); */
    }
    handleScroll () {
        var navbar = document.getElementById("navbarSticky");
        if (window.scrollY > 50) {
            navbar.classList.add("sticky")
        } else if (window.scrollY < 50) {
            navbar.classList.remove("sticky")
        }
    }
    onLogoutClick(e){
        e.preventDefault();
        this.props.logoutUser();
        this.props.clearProfile();
        localStorage.removeItem('aff_id');
        window.location.reload();
    }
    openNav(){
        document.getElementById("mainBody").classList.remove("mainBody")
        document.getElementById("mySidenav").style.marginLeft = "0px";
    }
    closeNav(){
        document.getElementById("mainBody").classList.add("mainBody")
        document.getElementById("mySidenav").style.marginLeft = "-250px";
    }
    slideDownClick(e,id){
        console.log(e)
        console.log(id)
    }
    componentWillReceiveProps(nextProps){
        if(nextProps.errors){
          this.setState({errors:nextProps.errors})
        }              
      }    
      openModal() {
        this.setState({modalIsOpen: true});
      }
    
      afterOpenModal() {
        this.subtitle.style.color = '#f00';
      }    
      closeModal() {
        this.setState({modalIsOpen: false});
      }
      onChange(e) {
        this.setState({
            storage:e.target.value
            
        });
        this.setState({modalIsOpen: true});   
    }
    search(e){
        this.setState({
            search:e.target.value            
        }) 
            this.props.getSearch(e.target.value);  
               
    }
    ChangeSearch(e){        
        this.setState({
            search:''            
        })
        let search=''        
        this.props.getSearch(search); 
        
    }
    Central (e,id) {
        e.preventDefault();
        let {items} = this.props.cart;       
        if (items.length == 0) {
        const userData = {
            storage: id,
        };         
         this.props.changeCentral(userData)
         window.location.href = '/';
        }
        else{
            alert('Clear your cart please');        
        }     
    }
    onSubmit(e) {
        e.preventDefault();
        let {items} = this.props.cart;      
        const userData = {
            storage: this.state.storage,
        }; 
        
        if (items.length == 0) {
            this.props.changeCentral(userData);                
            window.location.reload(); 
        }
        else{
            alert('Clear your cart please');
            
        }
             
    }
    render() {
        const {isAuthenticated} = this.props.auth;
        const {categories,procategory} = this.props.categories;
        const {search} = this.props.search; 
        const {items} = this.props.cart;
        const {errors} = this.state;        
        const {products} = this.props.products;
        let linkk=isAuthenticated ? items.length == 0 ?window.location.pathname:'/your-shopping-cart':'/sign-in';        
        const marchant =this.props.marchants.marchants;
        const warhouse =this.props.marchants.warhouses; 
              
        /* products.length>0? [...new Set(products.map(p=> p.string.split(',')[1]))].map(p =>console.log(p)
        ):null */
        return (
            <Fragment>
                <div className="container-fluid mainNav" id="headerContainer">
                    <div className="row" style={{borderBottom: '1px solid #692db7',backgroundColor: '#421b9b'}}>
                        <div className="col-md-5">
                            <ul className="largenav nav">
                                <li className="nav-item text-white pt-2 pl-2">Hot Line: 01611328179</li>
                            </ul>
                        </div>
                        <div className="col-md-7">
                            { isAuthenticated ? 
                            <ul className="nav justify-content-end">                                     
                                
                                <li className="nav-item"><Link className="nav-link" to="" onClick={this.openModal}>{Object.keys(warhouse).length != 0 ? warhouse.storage_name:'Central'}</Link></li>
                                <li className="nav-item"><Link className="nav-link" to="" onClick={(e) => this.Central(e,8)}>Central</Link></li>
                                <Modal
                                ariaHideApp={false}
                                     className="Modal__Bootstrap modal-dialog"
                                    closeTimeoutMS={150}
                                    isOpen={this.state.modalIsOpen}
                                    onRequestClose={this.closeModal}
                                    >
                                    <div className="modal-content">
                                        <div className="modal-header">
                                        <h4 className="modal-title">Storage Change</h4>
                                        <button type="button" className="close" onClick={this.closeModal}>
                                            <span aria-hidden="true">&times;</span>
                                            <span className="sr-only">Close</span>
                                        </button>
                                        </div>
                                        <div className="modal-body">
                                        <div className="card-body">
                                            <form onSubmit={this.onSubmit}>                                                
                                            <div className="form-group col-md-12">
                                                <label htmlFor="inputState">Storage</label>
                                                <select id="inputState"  className="form-control" name="storage" onChange={this.onChange} error={ errors.storage ? errors.storage[0] : null }> 
                                                    <option>..........Select storage.............</option>
                                                    {marchant.length > 0 ? marchant.map( mar => 
                                                    <option key={mar.id}  value={mar.id}>{mar.name}</option>
                                                    ):null}
                                                </select>
                                                </div>
                                                <div className="form-group col-md-4">
                                                <button
                                                    type="submit"
                                                    className="btn btn-outline-success" onClick={this.closeModal}
                                                >
                                                    Save
                                                </button>
                                                </div>
                                            </form>
                                        </div>
                                        </div>
                                        <div className="modal-footer">
                                        <button type="button" className="btn btn-danger" onClick={this.closeModal}>Close</button>
                                        
                                        </div>
                                    </div>
                                    </Modal>
                                <li className="nav-item"><Link className="nav-link" to="/profile">Profile</Link></li>
                                <li className="nav-item"><Link className="nav-link" to="/dashboard">Dashboard</Link></li>
                                <li className="nav-item"><Link className="nav-link" to="#" onClick={this.onLogoutClick.bind(this)}>Log Out</Link></li>
                            </ul>
                            : 
                            <ul className="nav justify-content-end">
                                <li className="nav-item"><Link className="nav-link active" to="/sign-in">Log In</Link></li>
                                <li className="nav-item"><Link className="nav-link" to="/sign-up">Sign Up</Link></li>
                            </ul>
                            }
                        </div>
                    </div>
                    <div className="row fixedDiv" id="navbarSticky">
                        <div className="col-md-3">
                            <div className="row justify-content-between">
                                <h4 className="col"><span className="smallnav menu"><Link className="p-2 text-white" to="/">unistag</Link></span></h4>
                                <span className="smallnav col text-right">
                                    <Link to={items.length == 0 ?window.location.pathname:'/your-shopping-cart'}><i className="navIcon fa fa-shopping-cart">
                                        <span className="navIconBadge badge badge-danger">{items.length > 0 ? items.length : 0}</span>
                                    </i></Link>                    
                                    <i  onClick={this.openNav} className="navIcon fa fa-bars"></i>
                                </span>
                            </div>
                            <h1 style={{margin:'-10px 0px'}}>
                                <span className="largenav">
                                    <Link className="p-2 text-white" to="/">
                                    {/* <img className="text-right" src={logo} alt="logo"width="10%"/> */}Unistag
                                    </Link>
                                    <i  onClick={this.openNav} className="navIcon fa fa-bars"></i>
                                </span>
                            </h1>
                        </div>
                        <div className="col-md-7 col-xs-11">
                            <div className="flipkart-navbar-search smallsearch">
                                <div className="input-group input-group-lg">
                                    <input type="text" className="form-control navSearch bga" onChange={this.search} placeholder="Search In Unistag" aria-label="Large" aria-describedby="inputGroup-sizing-sm"/>
                                    <div className="input-group-prepend">
                                        <span className="input-group-text bga text-white"><i className="fa fa-search"></i></span>
                                    </div>
                                </div>
                                <div className="searh" onClick={this.ChangeSearch} >
                                    {search.length > 0  && search.length < 100 ? search.map( product => <Search key={product.id} product={product} /> ):null}
                                </div>
                                
                            </div>
                        </div>
                        <div className="col-md-2">
                            <div className="cart largenav">
                                <Link to={items.length == 0 ?window.location.pathname:'/your-shopping-cart'}>
                                    <i className="navIcon fa fa-shopping-cart">
                                        <span className="navIconBadge badge badge-danger">{items.length > 0 ? items.length : 0}</span>
                                    </i>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="mySidenav" className="sidenav">
                    <h4 className="px-4 py-3">Categories</h4>
                    <a href="javascript:void(0)" className="closebtn text-info" onClick={this.closeNav}>×</a>
                    <ul className="nav flex-column">
                   {  procategory.length>0? [...new Set(procategory.map(p=> p.string.split(',')[1]))].map(p => 
                      categories.length > 0 ? categories.map( cat => (cat.id == p) ? 
                     
                        <li className="nav-item dropdown d-flex justify-content-between" key={cat.id}>
                        <Anchor 
                            key={cat.id} 
                            id={cat.id} 
                            value={cat.name} 
                            slug={`${cat.slug}/${cat.string}`}
                            link="/category/"
                            className="nav-link"
                            onSlidedownClick={this.slideDownClick}
                            />
                            <i className={`fa fa-caret-down nav-link`}></i></li>                            
                   
                    : null
                    ): 'Wait, Category Loading ...'):null}
                    </ul>
                </div>
            </Fragment>
        );
    }
}
Navbar.propTypes = {
    logoutUser: PropTypes.func.isRequired,
    auth: PropTypes.object.isRequired,
    categories: PropTypes.object.isRequired,    
    cart: PropTypes.object.isRequired,
}
const mapStateToProps = (state) => ({
    auth: state.auth,
    categories: state.category,
    marchants: state.marchant,
    cart: state.cart,
    search: state.search,
    products: state.product,
})
export default connect(mapStateToProps, {proCategory,getProduct,unmountProduct,logoutUser,clearProfile,getCategories,changeCentral,getStorage,getWarhouse,getSearch})(Navbar);