/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_stock_par.h                                     :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/19 14:33:30 by jmondino          #+#    #+#             */
/*   Updated: 2018/08/20 20:30:55 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#ifndef FT_STOCK_PAR_H
# define FT_STOCK_PAR_H

# include <stdlib.h>
# include <unistd.h>

typedef	struct		s_stock_par
{
	int				size_param;
	char			*str;
	char			*copy;
	char			**tab;
}					t_stock_par;

void				ft_putchar(char c);
struct s_stock_par	*ft_param_to_tab(int ac, char **av);

#endif
