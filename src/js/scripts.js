const popup = document.querySelector( '.post-popup' );
const currentDate = Math.round( Date.now() / 1000 );
const localData = localStorage.getItem( 'post-popup-read' );
const localDataExists = null !== localData;

/**
 * Close popup and create localData
 */
const close = () => {
	popup.style.display = 'none';
	localStorage.setItem( 'post-popup-read', currentDate );
};

/**
 * Open popup if there isn't localData
 */
const open = () => {
	popup.style.display = 'block';
}

/**
 * Remove localData if popup content was modified after creating localData or it was created more than 30 days earlier
 */
const maybeRemoveLocalData = () => {
	const modifiedDate = popup.getAttribute( 'data-modified' );

	if ( Number.parseInt( modifiedDate ) > Number.parseInt( localData ) || 2592000 < currentDate - Number.parseInt( localData ) ) {
		localStorage.removeItem( 'post-popup-read' );
		open();
	}
}

if ( popup ) {
	const closeButton = popup.querySelector( '.post-popup__footer button' );
	closeButton.addEventListener( 'click', close );

	if ( localDataExists ) {
		document.addEventListener( 'DOMContentLoaded', maybeRemoveLocalData );
	} else {
		document.addEventListener( 'DOMContentLoaded', open );
	}
}
