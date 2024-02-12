import React from 'react';

export default function (props) {
    return <div className="card">
        <div className="card-header">
            <h5 className="card-title">Card Title</h5>
            <p className="card-description">Card Description</p>
        </div>
        <div className="card-content">
            <p>Card Content</p>
        </div>
        <div className="card-footer">
            <p>Card Footer</p>
        </div>
    </div>;
}
