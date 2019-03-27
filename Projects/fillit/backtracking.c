/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   backtracking.c                                     :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: adequidt <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/15 16:45:46 by adequidt          #+#    #+#             */
/*   Updated: 2019/02/20 16:55:32 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "fillit.h"

/*
** Le coeur du backtracking
** Grosse leak avec la perte du pointeur str, a corriger
** La fonction se rappelle jusqu'a ce qu'on ait atteint le dernier ttrm.
*/

int		backtrack(t_trm *tet, char *str, int i)
{
	while (1)
	{
		if (str == NULL)
			str = create_str(tet[0].v_line);
		if (!(place_ttrm(tet, str, i)))
		{
			if (i == 0)
			{
				(tet[0]).v_line++;
				upgrade_ttrm(tet, tet[0].v_line);
				ft_memdel((void **)&str);
			}
			else
				(tet[--i]).j++;
		}
		else
		{
			i++;
			if (tet[i].x1 == tet[i].x4)
				print_str(str, tet[0].v_line);
		}
	}
}

/*
** Une fonction qui se contente de placer et d'effacer les ttrm,
** pour ne pas alourdir la fonction backtrack
*/

int		place_ttrm(t_trm *tet, char *str, int i)
{
	if (ttrm_try(str, tet, i))
		return (1);
	if (i > 0)
		erase_ttrm(tet[i - 1], str);
	return (0);
}

/*
** La fonction au coeur du placement des ttrm.
** Renvoie 1 si le ttrm a ete place, et 0 si apres avoir teste toutes les
** positions cela s'est revele impossible, en remettant alors tet.j a 0.
*/

int		ttrm_try(char *str, t_trm *tet, int i)
{
	while (!(check_upgrade(str, tet[i], tet[0].v_line)) &&
			(tet[i].j + tet[i].x4) < ft_strlen(str))
		(tet[i]).j++;
	if (strmerge(str, tet[i], tet[0].v_line))
		return (1);
	else
	{
		(tet[i]).j++;
		if ((tet[i].j + tet[i].x4) < ft_strlen(str))
			return (ttrm_try(str, tet, i));
	}
	tet[i].j = 0;
	return (0);
}

void	erase_ttrm(t_trm tet, char *str)
{
	str[tet.x1 + tet.j] = '.';
	str[tet.x2 + tet.j] = '.';
	str[tet.x3 + tet.j] = '.';
	str[tet.x4 + tet.j] = '.';
}
