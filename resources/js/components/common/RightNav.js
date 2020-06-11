import React from 'react';
import Anchor from './Anchor'

const RightNav = () => {
  return (
      <nav className="nav flex-column">
        <Anchor 
            link="/dashboard"
            className="nav-link"
            value="DM Dash"
            slug=""
        />
        <Anchor 
            link=""
            className="nav-link"
            value="Profile"
            slug="/profile"
        />
        <Anchor 
            link="/dashboard"
            className="nav-link"
            value="Affiliates"
            slug="/affiliates"
        />
        <Anchor 
            link="/dashboard"
            className="nav-link"
            value="Transfer"
            slug="/transfer"
        />
    </nav>
  )
}
export default RightNav