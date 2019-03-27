/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   adaptation.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <jmondino@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/08 09:39:12 by jmondino          #+#    #+#             */
/*   Updated: 2019/02/20 16:48:48 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "fillit.h"

/*
**	Gestion du downgrade des ttrm, au cas ou le plus petit carre ne serait pas
**	4 mais 2 (un seul cas possible, gere avec exit()) ou 3
*/

int		downgrade_ttrm(t_trm *tet, int v_line)
{
	int		i;

	if (v_line == 2 && tet[1].x1 == tet[1].x2)
	{
		ft_putstr("AA\nAA\n");
		exit(0);
	}
	i = 0;
	while (tet[i].x1 != tet[i].x2)
	{
		if (!(check_downgrade(tet[i])))
			return (0);
		i++;
	}
	i = 0;
	while (tet[i].x1 != tet[i].x2)
	{
		tet[i].x1 -= (tet[i].x1 / (v_line + 1));
		tet[i].x2 -= (tet[i].x2 / (v_line + 1));
		tet[i].x3 -= (tet[i].x3 / (v_line + 1));
		tet[i].x4 -= (tet[i].x4 / (v_line + 1));
		i++;
	}
	return (1);
}

/*
** Augmenter l'index des points des ttrm en fonction de la nouvelle v_line
*/

void	upgrade_ttrm(t_trm *tet, int v_line)
{
	int	i;

	i = 0;
	while (tet[i].x1 != tet[i].x2)
	{
		tet[i].x1 += (tet[i].x1 / (v_line - 1));
		tet[i].x2 += (tet[i].x2 / (v_line - 1));
		tet[i].x3 += (tet[i].x3 / (v_line - 1));
		tet[i].x4 += (tet[i].x4 / (v_line - 1));
		i++;
	}
}

/*
** Checks pour verifier que les tetriminos restent corrects, via division et
** modulo de v_line. Partie complexe du code.
*/

void	first_upgrade(t_trm *tet, int v_line)
{
	int		i;

	i = 5;
	while (i <= v_line)
	{
		upgrade_ttrm(tet, i);
		i++;
	}
}

/*
** Determine si les ttrm ont toujours la meme forme, en comparant les
** lignes de depart avec les lignes obtenues en ajoutant tet.j
** Retourne 1 si les lignes sont respectees, 0 sinon.
*/

int		check_upgrade(char *str, t_trm tet, int v_line)
{
	int		pre_diff[3];
	int		post_diff[3];

	pre_diff[0] = ((tet.x1) / v_line) - ((tet.x2) / v_line);
	pre_diff[1] = ((tet.x2) / v_line) - ((tet.x3) / v_line);
	pre_diff[2] = ((tet.x3) / v_line) - ((tet.x4) / v_line);
	post_diff[0] = ((tet.x1 + tet.j) / v_line) - ((tet.x2 + tet.j) / v_line);
	post_diff[1] = ((tet.x2 + tet.j) / v_line) - ((tet.x3 + tet.j) / v_line);
	post_diff[2] = ((tet.x3 + tet.j) / v_line) - ((tet.x4 + tet.j) / v_line);
	if ((pre_diff[0] != post_diff[0] || pre_diff[1] != post_diff[1] ||
				pre_diff[2] != post_diff[2]))
		return (0);
	return (1);
}

/*
** La meme chose mais pour diminuer les ttrms a la creation. Check pour verifier
** qu'on peut sans mal faire un v_line de plus petite taille.
*/

int		check_downgrade(t_trm tet)
{
	if (tet.x4 > 11)
		return (0);
	if (tet.x1 == 3 || tet.x1 == 7 || tet.x1 == 11 ||
			tet.x2 == 3 || tet.x2 == 7 || tet.x2 == 11 ||
			tet.x3 == 3 || tet.x3 == 7 || tet.x3 == 11 ||
			tet.x4 == 3 || tet.x4 == 7 || tet.x4 == 11)
		return (0);
	return (1);
}
