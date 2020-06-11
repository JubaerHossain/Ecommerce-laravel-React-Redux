import React from 'react';
import classnames from 'classnames';
import PropTypes from 'prop-types';
const TextareaFieldGroup = ({
    name,placeholder,value,label,info,error,onChange,disabled
}) => {
  return (
    <div>
      <div className="form-group">
            <label htmlFor="name">{label}</label>
            <textarea
                className={classnames('form-control', {'is-invalid':error})}
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
TextareaFieldGroup.propTypes = {
    name: PropTypes.string.isRequired,
    placeholder: PropTypes.string,
    value: PropTypes.string.isRequired,
    label: PropTypes.string,
    info: PropTypes.string,
    error: PropTypes.string,
    onChange: PropTypes.func.isRequired,
    disabled: PropTypes.string,
}
export default TextareaFieldGroup;