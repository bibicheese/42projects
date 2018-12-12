/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_advanced_sort_wordtab.c                         :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/22 11:27:48 by jmondino          #+#    #+#             */
/*   Updated: 2018/08/22 11:40:52 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

void	ft_advanced_sort_wordtab(char **tab, int (*cmp)(char *, char *))
{
	int		i;
	int		n;
	char	*stock;

	i = -1;
	while (tab[++i])
	{
		n = i;
		while (tab[++n])
		{
			if (cmp(tab[i], tab[n]) > 0)
			{
				stock = tab[i];
				tab[i] = tab[n];
				tab[n] = stock;
			}
		}
	}
}
