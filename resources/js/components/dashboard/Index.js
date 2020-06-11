import React, { Component, Fragment } from 'react'
import {PropTypes} from 'prop-types';
import {connect} from 'react-redux';
import { getDashboard, transferAmmount } from '../../actions/profileAction';
import RightNav from '../common/RightNav';

class Index extends Component {
constructor(props){
    super(props);
    this.state = {
        target: 3000,
        incentive:0,
        display:false
    }
}
componentDidMount(){
    this.props.getDashboard();
    const today = new Date();
    if(today.getDate() >= 25 && today.getDate() <=28){
        this.setState({display:true})
    }
}
calculate(target, sd){
    const per = ((sd * 100)/target).toFixed(2);
    return per;
}
calculateAchieved(target, sd,incentive){
    const per = ((sd * 100)/target).toFixed(2);
    const achivedTot = ((incentive * per)/100).toFixed(2);
    const tot = (Number(achivedTot) + sd)
    const vals = { achieved: achivedTot, tot:tot }
    return vals;
}
transfer(){
    this.props.transferAmmount();
}
  render() {
    const {dashboard} = this.props.profile
    console.log(dashboard);
    
    const {error} = this.props
    return (
        <Fragment>
            <div className="container mt-5">
                <div className="row">
                    <div className="col-md-4">
                        <RightNav />
                    </div>
                    <div className="col-md-8">
                    {error.length > 0 ? <h4>Still your Wallet is empty!!!</h4>:null}
                    {dashboard ? 
                    <table className="table table-bordered">
                            <thead>
                                <tr>
                                    <th colSpan="5" className="text-center">Target & Achievement</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="col">Target</th>
                                    <td>{this.state.target}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Self + DM</th>
                                    <td>{dashboard.self + dashboard.affiliate}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Incentive</th>
                                    <td>{dashboard.incentive}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Achieved</th>
                                    <td>{this.calculate(this.state.target, (dashboard.self + dashboard.affiliate), dashboard.incentive)}%</td>
                                </tr>
                                <tr>
                                    <th scope="col">Approved Incentive</th>
                                    <td>{this.calculateAchieved(this.state.target, (dashboard.self + dashboard.affiliate), dashboard.incentive).achieved}</td>
                                </tr>
                            </tbody>
                        </table>  : null}
                        {this.state.display ? <button onClick={this.transfer.bind(this)} className="btn btn-info">Transfer</button> : null}
                        <br />
                        <hr />
                        <br />
                        <br />
                        {dashboard ?  <table className="table table-bordered">
                            <thead>
                                <tr>
                                    <th colSpan="4" className="text-center">Income Overview</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="col">Self</th>
                                    <td>{dashboard.self}</td>
                                </tr>
                                <tr>
                                    <th scope="col">DM</th>
                                    <td>{dashboard.affiliate}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Incentive</th>
                                    <td>{this.calculateAchieved(this.state.target, (dashboard.self + dashboard.affiliate), dashboard.incentive).achieved}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Total</th>
                                    <td>{this.calculateAchieved(this.state.target, (dashboard.self + dashboard.affiliate), dashboard.incentive).tot}</td>
                                </tr>
                            </tbody>
                        </table> : null}
                    </div>
                </div>
            </div>
        </Fragment>
    )
  }
}
Index.propTypes = {
    auth: PropTypes.object.isRequired,
    error: PropTypes.object.isRequired,
    profile: PropTypes.object.isRequired,
}
const mapStateToProps = state => ({
    auth: state.auth,
    profile: state.profile,
    error: state.errors,
})
export default connect(mapStateToProps, {getDashboard, transferAmmount})(Index)