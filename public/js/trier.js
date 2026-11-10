document.addEventListener("DOMContentLoaded", () => {
  const combinaisons = window.combinaisons || [];
  const tailleInput = document.getElementById("taille-input");
  const couleurInput = document.getElementById("couleur-input");
  const tailleAffichage = document.getElementById("taille-selectionnee");
  const couleurAffichage = document.getElementById("couleur-selectionnee");

  if (combinaisons.length === 0) {
    console.error("Aucune combinaison disponible");
    return;
  }

  let tailleSelectionnee = null;
  let couleurSelectionnee = null;

  function mettreAJourAffichage() {
    tailleAffichage.textContent = tailleSelectionnee ? tailleSelectionnee.taille : "-";
    couleurAffichage.textContent = couleurSelectionnee ? couleurSelectionnee.couleur : "-";
    tailleInput.value = tailleSelectionnee ? tailleSelectionnee.taille_id : "";
    couleurInput.value = couleurSelectionnee ? couleurSelectionnee.couleur_id : "";
  }

  function mettreAJourGrilleTailles() {
    const couleursValides = couleurSelectionnee ? 
      combinaisons.filter(item => String(item.couleur_id) === String(couleurSelectionnee.couleur_id)).map(item => item.taille) : 
      [];

    document.querySelectorAll(".grid p").forEach(p => {
      const tailleDuTag = p.dataset.taille;
      const estDisponible = !couleurSelectionnee || couleursValides.includes(tailleDuTag);
      
      p.classList.toggle("non-disponible", !estDisponible);
      p.classList.toggle("selected", tailleSelectionnee && tailleSelectionnee.taille === tailleDuTag);
    });
  }

  function mettreAJourGrilleCouleurs() {
    const taillesValides = tailleSelectionnee ? 
      combinaisons.filter(item => String(item.taille_id) === String(tailleSelectionnee.taille_id)).map(item => item.couleur) : 
      [];

    document.querySelectorAll(".couleur-grid p").forEach(p => {
      const couleurDuTag = p.dataset.couleur;
      const estDisponible = !tailleSelectionnee || taillesValides.includes(couleurDuTag);
      
      p.classList.toggle("non-disponible", !estDisponible);
      p.classList.toggle("selected", couleurSelectionnee && couleurSelectionnee.couleur === couleurDuTag);
    });
  }

  function selectionnerTaille(tailleId, taille) {
    tailleSelectionnee = { taille_id: tailleId, taille: taille };
    
    if (couleurSelectionnee) {
      const combinaisonExiste = combinaisons.some(item => 
        String(item.taille_id) === String(tailleId) && 
        String(item.couleur_id) === String(couleurSelectionnee.couleur_id)
      );
      if (!combinaisonExiste) {
        couleurSelectionnee = null;
      }
    }
    
    mettreAJourAffichage();
    mettreAJourGrilleTailles();
    mettreAJourGrilleCouleurs();
  }

  function selectionnerCouleur(couleurId, couleur) {
    couleurSelectionnee = { couleur_id: couleurId, couleur: couleur };
    
    if (tailleSelectionnee) {
      const combinaisonExiste = combinaisons.some(item => 
        String(item.couleur_id) === String(couleurId) && 
        String(item.taille_id) === String(tailleSelectionnee.taille_id)
      );
      if (!combinaisonExiste) {
        tailleSelectionnee = null;
      }
    }
    
    mettreAJourAffichage();
    mettreAJourGrilleTailles();
    mettreAJourGrilleCouleurs();
  }

  document.querySelector(".grid").addEventListener("click", (e) => {
    if (e.target.tagName === "P" && !e.target.classList.contains("non-disponible")) {
      const tailleId = e.target.dataset.tailleId;
      const taille = e.target.dataset.taille;
      selectionnerTaille(tailleId, taille);
    }
  });

  document.querySelector(".couleur-grid").addEventListener("click", (e) => {
    if (e.target.tagName === "P" && !e.target.classList.contains("non-disponible")) {
      const couleurId = e.target.dataset.couleurId;
      const couleur = e.target.dataset.couleur;
      selectionnerCouleur(couleurId, couleur);
    }
  });

  // Initialisation avec valeurs par défaut
  const tailleParDefaut = combinaisons.find(item => item.taille === "8");
  const couleurParDefaut = combinaisons.find(item => item.couleur === "Bleu");

  if (tailleParDefaut && couleurParDefaut) {
    const combinaisonExiste = combinaisons.some(item => 
      String(item.taille_id) === String(tailleParDefaut.taille_id) && 
      String(item.couleur_id) === String(couleurParDefaut.couleur_id)
    );
    
    if (combinaisonExiste) {
      selectionnerTaille(tailleParDefaut.taille_id, tailleParDefaut.taille);
      selectionnerCouleur(couleurParDefaut.couleur_id, couleurParDefaut.couleur);
    }
  }

  if (!tailleSelectionnee && !couleurSelectionnee && combinaisons.length > 0) {
    const premiere = combinaisons[0];
    selectionnerTaille(premiere.taille_id, premiere.taille);
    selectionnerCouleur(premiere.couleur_id, premiere.couleur);
  }

  mettreAJourGrilleTailles();
  mettreAJourGrilleCouleurs();
});