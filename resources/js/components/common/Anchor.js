import React from 'react';
import PropTypes from 'prop-types';
import { Link } from "react-router-dom";
const Anchor = ({
    id,link,className,value,slug,onSlidedownClick,
}) => {
  return (
        <Link className={className} to={link+slug} onClick={() => onSlidedownClick.bind(this,id)}>
            {value}
        </Link>
  )
}
Anchor.propTypes = {
    link: PropTypes.string.isRequired,
    className: PropTypes.string,
    value: PropTypes.string.isRequired,
    slug: PropTypes.string.isRequired,
}
Anchor.defaultProps ={
    link: '#'
}
export default Anchor;