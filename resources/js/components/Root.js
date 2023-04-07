import React from 'react';
import ReactDOM from 'react-dom';
  
function Root() {
    return (
        <div className="container">
            <div className="">
                <div className="">
                    <div className="">
                        <div className="">Root Component</div>

                        <div className="">I'm the root component!</div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Root;

if (document.getElementById('root')) {
    ReactDOM.render(<Root />, document.getElementById('root'));
}
