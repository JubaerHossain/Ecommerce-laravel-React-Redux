import React from 'react';
import classnames from 'classnames';
import PropTypes from 'prop-types';
const TextFieldGroup = ({
    name,placeholder,value,label,info,type,error,onChange,disabled
}) => {
  return (
    <div>
      <div className="form-group">
            <label htmlFor="name">{label}</label>
            <input
                className={classnames('form-control', {'is-invalid':error})}
                type={type}
                name={name}
                placeholder={placeholder}
                value={value}
                onChange={onChange}
                disabled={disabled}
            />
            {info && <small className="form-text text-muted">{info}</small>}
            {error && (<div className="invalid-feedback">
                {error}
            </div>)}
        </div>
    </div>
  )
}
TextFieldGroup.propTypes = {
    name: PropTypes.string.isRequired,
    placeholder: PropTypes.string,
    value: PropTypes.string.isRequired,
    label: PropTypes.string,
    info: PropTypes.string,
    type: PropTypes.string.isRequired,
    error: PropTypes.string,
    onChange: PropTypes.func.isRequired,
    disabled: PropTypes.string,
}
TextFieldGroup.defaultProps ={
    type: 'text'
}
export default TextFieldGroup;