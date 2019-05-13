class Nameber_Card extends React.Component {
  render() {
    return (
      <div className="col-sm-6 col-md-4 col-lg-3 col-xl-5ths">
        <div className="card mx-0 mb-2 mb-sm-3 mb-md-4">
          <div className="card-body">
            <h4 className="card-title">{this.props.title}</h4>
            <p className="card-text">{this.props.body}</p>
          </div>
        </div>
      </div>
    );
  }
}
